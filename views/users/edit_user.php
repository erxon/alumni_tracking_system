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
    $change_password = filter_input(INPUT_POST, "change_password");
    $delete_profile = filter_input(INPUT_POST, "delete_profile");

    if (isset($change_password)) {
        //Change Password
        changePassword($id, $user);
    }
    if (isset($delete_profile)) {
        //Delete profile
        deleteUser($id, $user);
        header("Location: /thesis/users");
    }
}
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <div class="d-flex">
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
        <div class="main-body-padding admin-views">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/users">Users</a></li>
                    <li class="breadcrumb-item"><a href=<?php echo "/thesis/users?id=" . $id ?>><?php echo $rows["username"]; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <!--Basic information-->
            <?php include("/xampp/htdocs/thesis/views/users/edit_user/basic_information.php"); ?>
            <form class="delete-user mb-3" method="post">
                <p class="mb-1">Delete user</p>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal" type="button">Delete</button>
                <div class="modal fade" id="confirm-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-danger" name="delete_profile" value="Delete" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } else { ?>
    <div class="edit-user mx-auto">
        <!--Change photo-->
        <div class="mb-3">
            <?php include("/xampp/htdocs/thesis/views/users/edit_user/change_photo.php"); ?>
        </div>
        <!--Basic information-->
        <div class="mb-3">
            <?php include("/xampp/htdocs/thesis/views/users/edit_user/basic_information.php"); ?>
        </div>
        <!--Change password-->
        <?php include("/xampp/htdocs/thesis/views/users/edit_user/change_password.php"); ?>
    </div>
<?php } ?>

<script>
    $("#change-password").on("submit", (event) => {
        event.preventDefault();
    })
</script>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>