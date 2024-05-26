<?php session_start(); ?>
<?php

require("/xampp/htdocs/thesis/models/Alumni.php");

$page = 0;
$min = 0;
$max = 0;

if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
    if ($page === 0) {
        header("Location: /thesis/error");
    }
}

$alumni = new Alumni();
$alumniAccounts = $alumni->getAllAlumni();

if ($page !== 0) {
    $alumniAccountsCount = count($alumniAccounts);
    $max = $page * 5;
    $min = $max - 4;

    if ($max > $alumniAccountsCount) {
        $max = $alumniAccountsCount;
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");

if (isset($_SESSION["type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "teacher" || $_SESSION["type"] == "principal")) { ?>
    <div class="d-flex">
        <div>
            <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
        </div>
        <div class="admin-views">
            <div class="mb-2 pt-5 pb-3 px-5">
                <h1>Alumni records</h1>
            </div>
            <div class="px-5">
                <?php include("/xampp/htdocs/thesis/views/alumni/alumni_all.php"); ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding" style="margin-top: 48px;">
        <h3>Alumni</h3>
        <?php include "/xampp/htdocs/thesis/views/alumni/alumni_all.php"; ?>
    </div>

<?php } ?>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/alumni/admin_search/script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>