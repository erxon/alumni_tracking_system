<?php session_start(); ?>
<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>

<?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <div class="d-flex">
        <?php include("/xampp/htdocs/thesis/views/template/admin.php") ?>
        <div class="main-body-padding admin-views">
            <?php include("/xampp/htdocs/thesis/views/user/profile.php"); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding" style="margin-top:48px;">
        <?php include("/xampp/htdocs/thesis/views/user/profile.php"); ?>
    </div>
<?php } ?>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>