<?php
require("/xampp/htdocs/thesis/models/Users.php");

$user = new Users();

$user_id = $_POST["user_id"];
$username = $_POST["username"];

$changes = ["username" => $username];

$result = $user->editUser($user_id, $changes);

if ($result == 1) {
    $response = ["response" => "User profile updated"];
    echo json_encode($response);
}