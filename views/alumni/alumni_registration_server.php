<?php
include("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();
$isUndergrad = false;

$values = array(
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
    "username" => $_POST["username"],
    "password" => $_POST["password"],
    "question1" => $_POST["question1"],
    "question2" => $_POST["question2"],
    "question3" => $_POST["question3"],
    "question4" => $_POST["question4"],
    "question5" => $_POST["question5"],
    "answer1" => $_POST["answer1"],
    "answer2" => $_POST["answer2"],
    "answer3" => $_POST["answer3"],
    "answer4" => $_POST["answer4"],
    "answer5" => $_POST["answer5"],
    "tracerSurveyAnswer1" => $_POST["tracer_survey_answer_1"],
    "tracerSurveyAnswer2" => $_POST["tracer_survey_answer_2"],
    "tracerSurveyAnswer3" => $_POST["tracer_survey_answer_3"],
    "tracerSurveyAnswer4" => $_POST["tracer_survey_answer_4"]
);

if ($values["presentStatus"] == "University Student") {
    $isUndergrad = true;
}

$userId = $alumni->signupUser(
    $values["username"],
    $values["firstName"],
    $values["lastName"],
    $values["email"],
    "alumni",
    $values["password"]
);

$result = $alumni->addAlumni($values, $userId, $isUndergrad);

if ($result == true) {
    $response = array("response" => "success");
    echo json_encode($response);
} else {
    $response = array("response" => $result);
    echo json_encode($response);
}
