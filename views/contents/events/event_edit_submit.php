<?php
session_start();
include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$str = rand();
$uniqueFilename = md5($str);

$coverImage = $_POST["coverImage"];
$eventStart = "";
$eventEnd = "";

if ($_FILES["coverImageFile"]["name"] != "") {
    $tempname = $_FILES["coverImageFile"]["tmp_name"];
    $target_file = "./public/images/cover/" . basename($_FILES["coverImageFile"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $coverImage = $uniqueFilename . '.' . $imageFileType;
    $folder = "./public/images/cover/" . $coverImage;

    move_uploaded_file($tempname, $folder);
}

if (
    isset($_POST["startDate"]) &&
    isset($_POST["startTime"]) &&
    isset($_POST["title"]) &&
    isset($_POST["body"])
) {
    $startDate = $_POST["startDate"];
    $startTime = $_POST["startTime"];
    $title = $_POST["title"];
    $body = $_POST["body"];

    $eventStart = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));

    if ($_POST["endDate"] && $_POST["endTime"]) {
        $startDate = $_POST["endDate"];
        $startTime = $_POST["endTime"];

        $eventEnd = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
    }

    $data = array(
        "title" => $title,
        "body" => $body,
        "eventStart" => $eventStart,
        "eventEnd" => $eventEnd,
        "coverImage" => $coverImage
    );

    $result = $contents->updateEvent($_POST["id"], $data);


    if ($result) {
        echo json_encode(array("success" => "event successfully edited"));
    }
}
