<?php
session_start();

require "/xampp/htdocs/thesis/views/template/header.php";


?>

<div class="main-body-padding" style="margin-top: 5%;">
    <div class="w-50 rounded shadow container-fluid p-3">
        <h1>Your account is still upon approval of the admin</h1>
        <div class="my-3 d-flex p-3 border align-items-center">
            <img style="width: 56px; height: 56px;" class="rounded-circle" src="<?php echo $_SESSION["photo"]; ?>" />
            <div class="ms-3 py-1">
                <p class="fw-bold m-0"><?php echo $_SESSION["first_name"] ." ". $_SESSION["last_name"]; ?></p>
                <p style="font-size: 14px;" class="m-0"><?php echo $_SESSION["email"] ?></p>
                <span class="badge text-bg-secondary"><?php echo $_SESSION["status"] ?></span>
            </div>
        </div>
        <p>Your account is still upon verification. If your registration wasn't approved in reasonable amount
            of time, kindly contact the admin.
        </p>
    </div>
</div>

<?php
require "/xampp/htdocs/thesis/views/template/footer.php";
?>