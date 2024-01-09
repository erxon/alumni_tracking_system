<?php
require("/xampp/htdocs/thesis/models/Users.php");

$user = new Users();

$user_id = $_POST["user_id"];
$username = $_POST["username"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];



$changes = array(
    "username" => $username,
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email
);

$result = $user->editUser($user_id, $changes);

if ($result == 1) {
    $response = array("response" => "User profile updated");
    echo json_encode($response);
}
?>