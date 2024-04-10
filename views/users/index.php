<?php session_start(); ?>
<?php

$page = $_GET["page"];

include("/xampp/htdocs/thesis/models/Users.php");
$users = new Users();

if (empty($_SESSION["username"])) {
    header("Location: /thesis/home");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>
<input hidden id="page_num" value="<?php echo $page - 1 ?>" />
<div class="d-flex">
    <div><?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?></div>
    <div class="admin-views">
        <div class="mb-2 pt-5 pb-3 px-5">
            <h1>Users</h1>
        </div>
        <div class="px-5">
            <?php include("users.php") ?>
        </div>
    </div>
</div>
<div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php include("add.php") ?>
            </div>
        </div>

    </div>
</div>
<?php 
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php"; 
?>