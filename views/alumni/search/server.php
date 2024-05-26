<?php

include "/xampp/htdocs/thesis/models/Alumni.php";

$alumni = new Alumni();

$firstName = $_POST["firstName"];
$middleName = $_POST["middleName"];
$lastName = $_POST["lastName"];
$track = $_POST["track"];
$strand = $_POST["strand"];
$batch = $_POST["year_graduated"];

$result = $alumni->searchAlumni(
    $firstName,
    $middleName,
    $lastName,
    $track,
    $strand,
    $batch
);


if ($result->num_rows > 0) {
    $result = $result->fetch_all();
    echo json_encode(["response" => true, "result" => $result]);
} else {
    echo json_encode(["response" => false]);
}
