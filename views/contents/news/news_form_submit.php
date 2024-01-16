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
    $_POST["title"] != "" &&
    $_POST["body"] != "" &&
    $_POST["description"] != "" &&
    $coverImage != ""
) {
    $title = $_POST["title"];
    $body = $_POST["body"];
    $description = $_POST["description"];

    $data = array(
        "title" => $title,
        "body" => $body,
        "description" => $description,
        "coverImage" => $coverImage

    );

    $result = $contents->createNews($data, $userId);

    if ($result) {
        echo json_encode(array("success" => "news successfully added"));
    }
} else {
    header('HTTP/1.1 400 Please fill all the required fields');
    echo json_encode(array("error" => "please fill all the required fields"));
}
