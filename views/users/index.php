<?php session_start(); ?>
<?php
if (empty($_SESSION["username"])) {
    header("Location: /thesis/home");
    return;
}
?>
<?php
include("/xampp/htdocs/thesis/models/Users.php");
$users = new Users();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
    $type = filter_input(INPUT_POST, "type", FILTER_DEFAULT);

    echo $type;

    $users->createUser(
        $username,
        $first_name,
        $last_name,
        $email,
        $type,
        $password
    );
    header("Location: /thesis/users");
}
?>

<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>
<div class="d-flex">
    <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    <div class="users row g-3 m-0 admin-views">
        <div style="border-right: 1px solid #1E1E1E;" class="col-lg-3 col-md-12  px-3">
            <?php include("add.php") ?>
        </div>
        <div class="col-lg-9 col-md-12 px-3">
            <?php include("users.php") ?>
        </div>
    </div>
</div>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>