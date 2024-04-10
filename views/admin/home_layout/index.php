<?php
session_start();

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
<?php include "/xampp/htdocs/thesis/views/template/header.php"; ?>
<div class="d-flex">
    <div><?php include "/xampp/htdocs/thesis/views/template/admin.php"; ?></div>
    <div class="admin-views">
        <div class="mb-2 pt-5 pb-3 px-5">
            <h1>Home page layout</h1>
        </div>
        <div class="px-5 py-3">
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
                            <img style="width: 100%; height: 200px; object-fit: cover" src="/thesis/public/images/cover/<?php echo $newsHighlight["coverImage"] ?>" />
                            <p class="fw-semibold m-0 mt-1"><?php echo $newsHighlight["title"] ?></p>
                            <p class="m-0"><?php echo $stringUtil->truncate($newsHighlight["description"], 50); ?></p>
                            <p style="font-size: 14px;" class="m-0 mt-3"><?php echo $stringUtil->dateAndTime($newsHighlight["dateCreated"]); ?></p>
                        </div>
                    </div>
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

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php" ?>