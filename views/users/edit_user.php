<?php session_start(); ?>

<?php
require("/xampp/htdocs/thesis/models/Users.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_URL);

$user = new Users();

$result = $user->getUser($id);

if (isset($result)) {
    $rows = $result->fetch_assoc();
}
?>
<?php
function basicInformation($user_id, $user)
{
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    $changes = array(
        "username" => $username,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email
    );

    $result = $user->editUser($user_id, $changes);

    if ($result == 1) {
        echo "<p class='succes'>Profile updated</p>";
    }
}

function changePassword($user_id, $user)
{
    $current_password = filter_input(INPUT_POST, "current_password", FILTER_DEFAULT);
    $new_password = filter_input(INPUT_POST, "new_password", FILTER_DEFAULT);

    $result = $user->changePassword($current_password, $new_password, $user_id);

    if ($result == 1) {
        echo "<p class='success'>Password Updated</p>";
    }
}

function deleteUser($user_id, $user)
{
    $user->deleteUser($user_id);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_profile = filter_input(INPUT_POST, "edit_profile");
    $change_password = filter_input(INPUT_POST, "change_password");
    $delete_profile = filter_input(INPUT_POST, "delete_profile");

    if (isset($edit_profile)) {
        //Edit Profile
        basicInformation($id, $user);
    }
    if (isset($change_password)) {
        //Change Password
        changePassword($id, $user);
    }
    if (isset($delete_profile)) {
        //Delete profile
        deleteUser($id, $user);
    }
}
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>


<div class="edit-user m-auto">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/users">Users</a></li>
            <li class="breadcrumb-item"><a href=<?php echo "/thesis/users?id=" . $id ?>><?php echo $rows["username"]; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <!--Basic information-->
    <?php include("/xampp/htdocs/thesis/views/users/edit_user/basic_information.php"); ?>
    <!--Change password-->
    <?php include("/xampp/htdocs/thesis/views/users/edit_user/change_password.php"); ?>
    <form class="delete-user mb-3" method="post">
        <p class="mb-1">Delete user</p>
        <input class="btn btn-sm btn-danger" type="submit" name="delete_profile" value="Delete" />
    </form>
</div>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>