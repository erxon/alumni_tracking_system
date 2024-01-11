<?php
session_start();
include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Contents.php");

$id = $_GET["id"];
$content = new Contents();
$contentDetails = $content->getContent($id);

function splitDateTime($dateTime)
{
    $dateTimeString = strtotime($dateTime);
    $date = date("Y-m-d", $dateTimeString);
    $time = date("H:m", $dateTimeString);

    return array("date" => $date, "time" => $time);
}

$eventStart = splitDateTime($contentDetails["eventStart"]);
$eventEnd = splitDateTime($contentDetails["eventEnd"]);


?>
<div style class="main-body-padding content-form">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents">Contents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
        </ol>
    </nav>
    <h3>Edit Event</h3>

    <form style="border-radius: 10px;" id="events-form-edit" class="mt-3 bg-white p-3" novalidate enctype="multipart/form-data">
        <input hidden name="id" value="<?php echo $id; ?>" />
        <div class="d-flex mb-3">
            <!----------------Start Time------------------>
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">Start Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input name="startDate" id="start-date" class="form-control" type="date" value="<?php echo $eventStart["date"]; ?>" required />
                        <label class="label" for="start-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <input name="startTime" id="start-time" class="form-control" type="time" value="<?php echo $eventStart["time"]; ?>" required />
                        <label class="label" for="start-time">Time</label>
                    </div>
                </div>
            </div>
            <!----------------End Time-------------------->
            <div class="flex-fill content-form-divider me-2 p-3">
                <p class="mb-3">End Time</p>
                <div class="d-flex">
                    <div class="flex-fill me-2">
                        <input name="endDate" id="end-date" class="form-control me-2" type="date" value="<?php echo $eventEnd["date"] ?>" />
                        <label class="label" for="end-date">Date</label>
                    </div>
                    <div class="flex-fill">
                        <input name="endTime" id="end-time" class="form-control" type="time" value="<?php echo $eventEnd["time"] ?>" />
                        <label class="label" for="end-time">Time</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <!----------------Image Upload-------------------->
            <?php
            if ($contentDetails["coverImage"] != "") { ?>
                <img class="mb-3" style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $contentDetails["coverImage"]; ?>" />
            <?php } ?>
            <input hidden name="coverImage" value="<?php echo $contentDetails["coverImage"]; ?>" />
            <input id="cover-image" name="coverImageFile" type="file" class="form-control" />
        </div>
        <div class="mb-5">
            <!--Title & Body-->
            <input value="<?php echo $contentDetails["title"] ?>" name="title" class="form-control mb-2" placeholder="Event name" required />
            <textarea id="content-body" name="body" placeholder="Content" required>
            <?php echo $contentDetails["body"] ?>
            </textarea>
        </div>

        <button type="button" data-bs-toggle="modal" data-bs-target="#on-edit-confirm" class="btn btn-dark">Save</button>
        <a href="/thesis/contents/events?id=<?php echo $id; ?>" role="button" class="btn btn-outline-secondary">Discard</a>

        <div class="modal fade" id="on-edit-confirm" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to save changes?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>