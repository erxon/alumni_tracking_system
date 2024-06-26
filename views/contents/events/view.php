<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$id = $_GET["id"];
$content = new Contents();
$contentDetails = $content->getContent($id);
$stringUtil = new StringUltilities();

if (isset($_POST["delete-action"])) {
    //delete post
    $content->deleteContent($id);
    header("Location: /thesis/contents/events/all?page=1");
}
?>

<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<div style="margin-top: 3%" class="main-body-padding">
    <div class="container-fluid w-75 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/thesis/contents/events/all?page=1">Events</a></li>
                <li class="breadcrumb-item"><?php echo $contentDetails["title"]; ?></li>
            </ol>
        </nav>
        <div class="d-flex mb-2 py-2 align-items-center">
            <h1 class="me-3 mb-0"><?php echo $contentDetails["title"]; ?></h1>
            <?php if (
                isset($_SESSION["type"]) &&
                $_SESSION["type"] == "admin"
            ) { ?>
                <a role="button" href="/thesis/contents/events/edit?id=<?php echo $contentDetails["id"]; ?>" class="btn btn-sm btn-light me-1"><i class="fas fa-pen"></i></a>
                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#on-delete-confirm"><i class="fas fa-trash"></i></button>
            <?php } ?>
        </div>

        <p class="mb-1" style="font-size: 14px;"><i class="far fa-clock"></i> Starts on: <?php echo $stringUtil->dateAndTime($contentDetails["eventStart"]); ?></p>
        <?php if ($contentDetails["eventEnd"] != "0000-00-00 00:00:00") { ?>
            <p style="font-size: 14px;"><i class="far fa-clock"></i> Ends on: <?php echo $stringUtil->dateAndTime($contentDetails["eventEnd"]); ?></p>
        <?php } ?>
        <img style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $contentDetails["coverImage"]; ?>" />
        <div class="container-fluid mt-3">
            <p><?php echo $contentDetails["body"]; ?></p>
        </div>
    </div>
</div>
<form method="post">
    <input hidden name="delete-action" value="delete" />
    <div class="modal fade" id="on-delete-confirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this event?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>