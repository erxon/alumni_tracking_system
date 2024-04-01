<?php

include "/xampp/htdocs/thesis/models/Alumni.php";

$alumni = new Alumni();

$search = $_POST["search"];

if ($search == "byName") {
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];

    $result = $alumni->searchByAlumniName($firstName, $middleName, $lastName);


    if ($result->num_rows > 0) {
        $result = $result->fetch_all();
        echo json_encode(["response" => true, "result"=>$result]);
    } else {
        echo json_encode(["response" => false]);
    }
}

if($search == "byTrackStrandYearGrad"){
    $track = $_POST["track"];
    $strand = $_POST["strand"];
    $yearGraduated = $_POST["year_graduated"];

    $result = $alumni->searchByTrackStrandYearGrad($track, $strand, $yearGraduated);

    if ($result->num_rows > 0) {
        $result = $result->fetch_all();
        echo json_encode(["response" => true, "result"=>$result]);
    } else {
        echo json_encode(["response" => false]);
    }

}