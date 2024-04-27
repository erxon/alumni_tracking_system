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

$values = [
    "photo" => $photo,
    "firstName" => $_POST["first_name"],
    "middleName" => $_POST["middle_name"],
    "lastName" => $_POST["last_name"],
    "contactNumber" => $_POST["contact_number"],
    "email" => $_POST["email"],
    "address" => $_POST["address"],
    "gender" => $_POST["gender"],
    "age" => $_POST["age"],
    "birthday" => $_POST["birthdate"],
    "dateGraduated" => $_POST["year_graduated"],
    "trackFinished" => $_POST["track"],
    "strandFinished" => $_POST["strand"],
    "presentStatus" => $_POST["present_status"],
    "instName" => $_POST["inst_name"],
    "instAddress" => $_POST["inst_address"],
    "specialization" => $_POST["specialization"],
    "program" => $_POST["program"],
    "expGraduationDate" => $_POST["exp_graduation_date"],
    "curriculumExit" => $_POST["curriculum_exit"],
    "question1" => $_POST["question1"],
    "question2" => $_POST["question2"],
    "question3" => $_POST["question3"],
    "question4" => $_POST["question4"],
    "question5" => $_POST["question5"],
    "question6" => $_POST["question6"],
    "answer1" => $_POST["answer1"],
    "answer2" => $_POST["answer2"],
    "answer3" => $_POST["answer3"],
    "answer4" => $_POST["answer4"],
    "answer5" => $_POST["answer5"],
    "answer6" => $_POST["answer6"],
    "tracerSurveyAnswer1" => $_POST["tracer_survey_answer_1"],
    "tracerSurveyAnswer2" => $_POST["tracer_survey_answer_2"],
    "tracerSurveyAnswer3" => $_POST["tracer_survey_answer_3"],
    "tracerSurveyAnswer4" => $_POST["tracer_survey_answer_4"]
];

if ($values["presentStatus"] == "University Student") {
    $isUndergrad = true;
}

$userId = $alumni->signupUser(
    $values["email"],
    "alumni",
);

$result = $alumni->addAlumni($values, $userId, $isUndergrad);

if ($result == true) {
    $response = ["response" => "success"];

    echo json_encode($response);
} else {
    $response = array("response" => $result);
    echo json_encode($response);
}
