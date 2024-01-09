<?php
require("/xampp/htdocs/thesis/models/Users.php");

$user = new Users();
$user_id = $_POST['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

$result = $user->changePassword($current_password, $new_password, $user_id);

if ($result == 1) {
    $response = array("response" => "Password Updated");
    echo json_encode($response);
}
