<?php
session_start();
include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$str = rand();
$uniqueFilename = md5($str);

$coverImage = "";
$eventStart = "";
$eventEnd = "";
$userId = $_SESSION["user_id"];


if (isset($_FILES) && count($_FILES) > 0) {
    $tempname = $_FILES["coverImage"]["tmp_name"];
    $target_file = "./public/images/cover/" . basename($_FILES["coverImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $coverImage = $uniqueFilename . '.' . $imageFileType;
    $folder = "./public/images/cover/" . $coverImage;

    move_uploaded_file($tempname, $folder);
}

if (
    isset($_POST["title"]) &&
    isset($_POST["body"])
) {
    $title = $_POST["title"];
    $body = $_POST["body"];

    $data = array(
        "title" => $title,
        "body" => $body,
        "coverImage" => $coverImage
    );

    $result = $contents->createNews($data, $userId);

    if ($result) {
        echo json_encode(array("success" => "event successfully added"));
    }
}
