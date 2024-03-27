<?php
session_start();

include "/xampp/htdocs/thesis/models/Contents.php";

$contents = new Contents();
$str = rand();
$uniqueFilename = md5($str);

$coverImage = "";
$questionId = 0;

//upload cover image
if (isset($_FILES) && count($_FILES) > 0) {
    $tempname = $_FILES["coverImage"]["tmp_name"];
    $target_file = "./public/images/cover/" . basename($_FILES["coverImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $coverImage = "$uniqueFilename.$imageFileType";
    $folder = "./public/images/cover/$coverImage";

    move_uploaded_file($tempname, $folder);
}

$values = [
    "title" => $_POST["title"],
    "description" => $_POST["description"],
    "coverImage" => $coverImage
];

$author = $_SESSION["user_id"];
$resultId = $contents->createSurvey($values, $author);

header("Location: /thesis/contents/surveys?id=$resultId");
