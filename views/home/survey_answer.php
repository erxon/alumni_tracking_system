<?php
session_start();

include("/xampp/htdocs/thesis/models/Home.php");
include("/xampp/htdocs/thesis/models/Database.php");
$home = new Home();

if (isset($_POST["survey_answer"])) {

    $userId = $_SESSION["user_id"];
    $answerId = $_POST["answer"];
    $surveyQuestion = $_POST["survey_question"];

    $result = $home->surveyAnswer($userId, $answerId, $surveyQuestion);
    if (isset($result)) {
        echo json_encode(array("status" => "success", "message" => "Survey Answered"));
    }
}
