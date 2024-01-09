<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<h1>Edit Profile</h1>
<!--Basic information-->
<form method="post">
    <input type="text" name="username" placeholder="username" value=<?php echo $_SESSION["username"] ?> /><br>
    <input type="text" name="first_name" placeholder="first name" value=<?php echo $_SESSION["first_name"] ?> /><br>
    <input type="text" name="last_name" placeholder="last name" value=<?php echo $_SESSION["last_name"] ?> /><br>
    <input type="email" name="email" placeholder="email" value=<?php echo $_SESSION["email"] ?> /><br>
    <input type="submit" name="edit_profile" value="Save" />
</form>
<!--Change password-->
<form method="post">
    <h2>Change password</h2>
    <input type="password" name="current_password" placeholder="current password" /><br>
    <input type="password" name="new_password" placeholder="New Password" /><br>
    <input type="submit" name="change_password" value="Save" />
</form>

<form method="post">
    <input type="submit" name="delete_profile" value="Delete Profile" />
</form>
<?php

require("/xampp/htdocs/thesis/models/Users.php");

function basicInformation($user)
{
    $user_id = $_SESSION["user_id"];
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
        header("Location: /thesis/user/index");
    }
}

function changePassword($user)
{
    $user_id = $_SESSION["user_id"];
    $current_password = filter_input(INPUT_POST, "current_password", FILTER_DEFAULT);
    $new_password = filter_input(INPUT_POST, "new_password", FILTER_DEFAULT);

    $result = $user->changePassword($current_password, $new_password, $user_id);

    if ($result == 1) {
        echo "<p class='success'>Password Updated</p>";
    }
}


function deleteUser($user)
{
    $user_id = $_SESSION["user_id"];
    $user->deleteUser($user_id);
}

$user = new Users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_profile = filter_input(INPUT_POST, "edit_profile");
    $change_password = filter_input(INPUT_POST, "change_password");
    $delete_profile = filter_input(INPUT_POST, "delete_profile");

    if (isset($edit_profile)) {
        //Edit Profile
        basicInformation($user);
    }
    if (isset($change_password)) {
        //Change Password
        changePassword($user);
    }
    if (isset($delete_profile)) {
        //Delete profile
        deleteUser($user);
    }
}

?>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>