<?php
session_start();
include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$str = rand();
$uniqueFilename = md5($str);

$coverImage = $_POST["coverImage"];
$questionId = 0;

//upload cover image
if (isset($_FILES) && count($_FILES) > 0) {
    $tempname = $_FILES["coverImage"]["tmp_name"];
    $target_file = "./public/images/cover/" . basename($_FILES["coverImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $coverImage = $uniqueFilename . '.' . $imageFileType;
    $folder = "./public/images/cover/" . $coverImage;

    move_uploaded_file($tempname, $folder);
}

//add a question to DB
if (
    isset($_POST["question"])
    && isset($_POST["body"])
    && $coverImage != ""
) {
    $result = $contents->updateSurveyQuestion($coverImage);

    if (!$result) {
        echo json_encode(array("response" => "Something went wrong"));
    }
}

//add answers to DB
if (isset($_POST["answers"]) && $_POST["answers"] > 0) {
    $result = $contents->updateSurveyAnswers();

    if (!$result) {
        echo json_encode(array("response" => "Something went wrong"));
    } else {
        echo json_encode(array("response" => "survey successfully added"));
    }
}
