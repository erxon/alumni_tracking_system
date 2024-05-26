<?php
include("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();
$isUndergrad = false;
$photo = "";



//photo upload
if ($_FILES["alumni_photo"]) {
    $str = rand();
    $uniqueFilename = md5($str);

    $tempname = $_FILES["alumni_photo"]["tmp_name"];
    $target_file = "./public/images/alumni/" . basename($_FILES["alumni_photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $photo = "$uniqueFilename.$imageFileType";
    $folder = "./public/images/alumni/$photo";

    move_uploaded_file($tempname, $folder);
}

$userID = $alumni->signupUser($_POST["first-name"], $_POST["last-name"],$_POST["email"], "alumni");
$alumniID = $alumni->addAlumni($photo, $userID);
$tracerStudy = $alumni->insertTracerStudy($alumniID);
$additionalInformation = $alumni->additionalFieldAnswer($alumniID);



if (
    isset($userID) &&
    isset($alumniID) &&
    isset($tracerStudy) &&
    isset($additionalInformation)
) {
    $response = ["response" => "success"];
    echo json_encode($response);
} else {
    $response = array("response" => false);
    echo json_encode($response);
}
