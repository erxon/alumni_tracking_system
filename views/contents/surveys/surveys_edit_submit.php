<?php
session_start();

include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$str = rand();
$uniqueFilename = md5($str);

$coverImage = $_POST["coverImage"];

//upload cover image
if ($_FILES["newCoverImage"]["name"] != "") {
    unlink("/xampp/htdocs/thesis/public/images/cover/$coverImage");
    
    $tempname = $_FILES["newCoverImage"]["tmp_name"];
    $target_file = "./public/images/cover/" . basename($_FILES["newCoverImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $coverImage = "$uniqueFilename.$imageFileType";
    $folder = "./public/images/cover/$coverImage";

    
    move_uploaded_file($tempname, $folder);
}

$values = [
    "id" => $_POST["id"],
    "title" => $_POST["title"],
    "description" => $_POST["description"],
    "coverImage" => $coverImage
];

$result = $contents->updateSurvey($values);

$id = $_POST["id"];
header("Location: /thesis/contents/surveys?id=$id");
