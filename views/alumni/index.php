<?php session_start(); ?>
<?php

require("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();

$alumniAccounts = $alumni->getAllAlumni();

$result = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $track = filter_input(INPUT_POST, "track", FILTER_SANITIZE_SPECIAL_CHARS);
    $strand = filter_input(INPUT_POST, "strand", FILTER_SANITIZE_SPECIAL_CHARS);
    $batch = filter_input(INPUT_POST, "batch", FILTER_SANITIZE_SPECIAL_CHARS);

    $result = $alumni->searchAlumni($name, $track, $strand, $batch);
}

?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <div class="d-flex">
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
        <div class="main-body-padding admin-views">
            <?php include("/xampp/htdocs/thesis/views/alumni/alumni_all.php"); ?></div>
    </div>
<?php } else { ?>
    <div class="main-body-padding" style="margin-top: 48px;">
        <h3>Alumni</h3>
        <?php include("/xampp/htdocs/thesis/views/alumni/alumni_all.php"); ?>
    </div>
    </div>
<?php } ?>

<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>