<?php
session_start();

include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/views/template/admin.php";

include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$stringUtil = new StringUltilities();
$contents = new Contents();

$eventContents = $contents->getContents("event");
$newsContents = $contents->getContents("news");
$homePageLayout = $contents->getHomePageLayout();
$eventHighlight = $contents->getContent($homePageLayout["eventHighlight"]);
$newsHighlight = $contents->getContent($homePageLayout["newsHighlight"]);

?>

<div class="main-body-padding admin-views">
    <div class="d-flex mb-3 align-items-center">
        <h5 class="m-0 me-3">Home page layout settings</h5>
        <button type="button" data-bs-toggle="modal" data-bs-target="#save-confirmation" class="btn btn-sm btn-outline-dark">Save</button>
    </div>
    <input hidden id="current-event-highlight" value="<?php echo $homePageLayout["eventHighlight"] ?>" />
    <input hidden id="current-news-highlight" value="<?php echo $homePageLayout["newsHighlight"] ?>" />
    <div class="row container-fluid">
        <div class="col-lg-4">
            <div class="bg-white rounded shadow-sm p-3">
                <h5>Event highlight</h5>
                <select id="event-selection" class="form-select" aria-label="Default select example">
                    <option selected value="">Select an event to highlight</option>
                    <?php foreach ($eventContents as $event) { ?>
                        <option <?php if ($homePageLayout["eventHighlight"] == $event[6]) {
                                    echo "selected";
                                } ?> value="<?php echo $event[6] ?>"><?php echo $event[0] ?></option>
                    <?php } ?>
                </select>

                <div id="event-preview-container" class="mt-3">
                    <img style="width: 100%; height: 200px;" src="/thesis/public/images/cover/<?php echo $eventHighlight["coverImage"] ?>" />
                    <p class="fw-semibold mt-1"><?php echo $eventHighlight["title"]; ?></p>
                    <p class="mt-1"><?php echo $stringUtil->truncate($eventHighlight["description"], 50); ?></p>
                    <div style="font-size: 14px;">
                        <p class="m-0"><span class="fw-semibold">Event start: </span> <?php echo $stringUtil->dateAndTime($eventHighlight["eventStart"]); ?></p>
                        <?php if ($eventHighlight["eventEnd"] != "0000-00-00 00:00:00") { ?>
                            <p class="m-0"><span class="fw-semibold">Event end: </span> <?php echo $stringUtil->dateAndTime($eventHighlight["eventEnd"]); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="bg-white rounded shadow-sm p-3">
                <h5>News highlight</h5>
                <select id="news-selection" class="form-select" aria-label="Default select example">
                    <option selected value="">Select a news to highlight</option>
                    <?php foreach ($newsContents as $news) { ?>
                        <option <?php if ($homePageLayout["newsHighlight"] == $news[6]) {
                                    echo "selected";
                                } ?> value="<?php echo $news[6] ?>"><?php echo $news[0] ?></option>
                    <?php } ?>
                </select>
                <div id="news-preview-container" class="mt-3">
                    <img style="width: 100%; height: 200px;" src="/thesis/public/images/cover/<?php echo $newsHighlight["coverImage"] ?>" />
                    <p class="fw-semibold m-0 mt-1"><?php echo $newsHighlight["title"] ?></p>
                    <p class="m-0"><?php echo $stringUtil->truncate($newsHighlight["description"], 50); ?></p>
                    <p style="font-size: 14px;" class="m-0 mt-3"><?php echo $stringUtil->dateAndTime($newsHighlight["dateCreated"]); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="save-confirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm layout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to save this layout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="save-home-page-layout" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    const contentsToHighlight = {
        event: $("#current-event-highlight").val(),
        news: $("#current-news-highlight").val()
    }

    $("#event-selection").on("change", (event) => {
        $("#event-preview-container").empty();
        console.log(event.target.value);
        const eventId = event.target.value;

        $.ajax({
            type: "GET",
            url: `/thesis/admin/home/layout/server?id=${eventId}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                const event = parsedResponse.result
                const eventStart = new Date(event.eventStart);
                const eventEnd = new Date(event.eventEnd);

                $("#event-preview-container").fadeIn();
                $("#event-preview-container").append(
                    `
                    <img style="width: 100%; height: 200px;" src="/thesis/public/images/cover/${event.coverImage}" />
                    <p class="fw-semibold mt-1">${event.title}</p>
                    <p class="mt-1">${event.description.substring(0, 50)}...</p>
                    <div style="font-size: 14px;">
                        <p class="m-0"><span class="fw-semibold">Event start: </span> ${eventStart.toDateString()} at ${eventStart.toLocaleTimeString()}</p>
                        <p class="m-0"><span class="fw-semibold">Event end: </span>${eventEnd.toDateString()} at ${eventEnd.toLocaleTimeString()}</p>
                    </div>
                    `
                );
            }

        });

        contentsToHighlight.event = eventId;
    });

    $("#news-selection").on("change", (event) => {
        $("#news-preview-container").empty();
        console.log(event.target.value);
        const newsId = event.target.value;

        $.ajax({
            type: "GET",
            url: `/thesis/admin/home/layout/server?id=${newsId}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                const news = parsedResponse.result;
                const newsDateCreated = new Date(news.dateCreated);

                $("#news-preview-container").fadeIn();
                $("#news-preview-container").append(
                    `
                    <img style="width: 100%; height: 200px;" src="/thesis/public/images/cover/${news.coverImage}" />
                    <p class="fw-semibold m-0 mt-1">${news.title}</p>
                    <p class="m-0">${news.description.substring(0, 50)}...</p>
                    <p style="font-size: 14px;" class="m-0 mt-3">${newsDateCreated.toDateString()}</p>
                    `
                );
            }
        });

        contentsToHighlight.news = newsId;
    });

    $("#save-home-page-layout").on("click", () => {
        console.log(contentsToHighlight);

        const toast = new bootstrap.Toast("#response");
        const data = new FormData();

        data.append("eventHighlight", contentsToHighlight.event);
        data.append("newsHighlight", contentsToHighlight.news);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/home/layout/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#toast-body").empty();
                if (response.response) {
                    toast.show();
                    $("#toast-body").append(`New home page layout successfully saved`);
                } else {
                    toast.show();
                    $("#toast-body").append(`Something went wrong`);
                }
            }
        });
    })
</script>


<?php include "/xampp/htdocs/thesis/views/template/footer.php" ?>