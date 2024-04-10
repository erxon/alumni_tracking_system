<?php
session_start();
include "/xampp/htdocs/thesis/models/Users.php";

$user = new Users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "delete-user") {
        $type = $_POST["type"];
        $id = $_POST["id"];

        $result = $user->deleteUser($id);

        if ($type == "alumni") {
            $user->deleteAlumniByUserId($id);
        }

        $updatedUsers = $user->getUsers(0);

        echo json_encode(["response" => $result, "users" => $updatedUsers->fetch_all()]);
    }

    if ($action == "create-user") {
        $username = $_POST["username"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $type = $_POST["type"];

        $result = $user->createUser(
            $username,
            $first_name,
            $last_name,
            $email,
            $type,
            $password
        );

        echo json_encode(["response" => $result]);
    }
    if ($action == "get-users") {
        $offset = $_POST['offset'];
        $users = $user->getUsers($offset);
        echo json_encode(["response" => true, "result" => $users->fetch_all()]);
    }

    if ($action == "edit-user-basic-information") {
        $id = $_POST["id"];
        $changes = [
            "username" => $_POST["username"],
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "email" => $_POST["email"]
        ];

        $result = $user->editUser($id, $changes);

        $_SESSION["username"] = $_POST["username"];
        $_SESSION["first_name"] = $_POST["first_name"];
        $_SESSION["last_name"] = $_POST["last_name"];
        $_SESSION["email"] = $_POST["email"];

        echo json_encode(["response" => $result]);
    }

    if ($action == "edit-user-password") {
        $id = $_POST["id"];

        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];

        $result = $user->changePassword($currentPassword, $newPassword, $id);

        echo json_encode(["response" => $result]);
    }

    if ($action == "get-status") {
        $userId = $_POST["userid"];

        $getStatus = $user->getAlumniStatus($userId);
        $result = $getStatus->fetch_assoc();

        echo json_encode(["response"=>$result["status"]]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $usersCount = $user->getNumberOfUsers();
    echo json_encode(["response" => $usersCount]);
}
