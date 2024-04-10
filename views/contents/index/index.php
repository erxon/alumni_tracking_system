<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}
?>
<?php
include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$contents = new Contents();
$stringUtil = new StringUltilities();
$recentlyAddedNews = $contents->recentlyAddedContents("news");
$recentlyAddedEvents = $contents->recentlyAddedContents("event");
$newGallery = $contents->newGallery();
$newSurvey = $contents->newSurvey();
?>

<?php

include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/views/contents/layout/header.php"
?>

<div class="container-fluid contents-container py-3">
    <?php include "add_contents.php" ?>
    <div class="my-3 bg-white rounded p-3">
        <?php include "recently_added_news.php" ?>
    </div>
    <div class="my-3 bg-white rounded p-3">
        <?php include "recently_added_events.php" ?>
    </div>
    <div class="d-flex my-3 bg-white rounded p-3">
        <div class="flex-fill me-2 border-end pe-2"><?php include "new_gallery.php" ?></div>
        <div class="flex-fill"><?php include "new_survey.php" ?></div>
    </div>

</div>

<?php
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>