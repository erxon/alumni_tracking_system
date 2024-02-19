<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>
<div class="d-flex">
    <div>
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    </div>
    <div class="main-body-padding admin-views">
        <?php include("/xampp/htdocs/thesis/views/contents/contents_nav.php"); ?>
        <div class="container-fluid contents-container">
            <p class="text-secondary my-4">Posted contents will appear here</p>
        </div>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>