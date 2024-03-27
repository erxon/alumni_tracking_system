<?php
include "/xampp/htdocs/thesis/models/Contents.php";

$contents = new Contents();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $action = $_POST["action"];
    if ($action == "create") {

        $surveyId = $_POST["surveyId"];
        $question = $_POST["question"];
        $numberOfAnswers = $_POST["numberOfAnswers"];
        $questionId = $contents->createQuestion($surveyId, $question);
        $addAnswers = $contents->addAnswers($questionId, $numberOfAnswers);

        if ($questionId && $addAnswers) {
            echo json_encode(["response" => "success"]);
        } else {
            echo json_encode(["response" => "failed"]);
        }
    }

    if ($action == "edit") {
        $questionId = (int) $_POST["question_id"];
        $question = $_POST["question"];
        $numberOfAnswers = $_POST["numberOfAnswers"];

        $result = $contents->updateQuestion($questionId, $question, $numberOfAnswers);

        echo json_encode(["response" => $result]);
    }

    if ($action == "delete") {
        $questionId = (int) $_POST["question_id"];

        $contents->deleteQuestion($questionId);

        echo json_encode(["response" => "success"]);
    }

    if ($action == "get-answers") {
        $questionId = $_POST["question_id"];
        $answers = $contents->getSurveyAnswers($questionId);

        echo json_encode(["response" => "success", "answers" => $answers]);
    }

    if ($action == "vote") {
        $questionId = $_POST["survey_question_id"];
        $answerId = $_POST["survey_answer"];
        $surveyId = $_POST["survey_id"];
        $userId = $_POST["user_id"];

        $result = $contents->vote(
            $questionId,
            $answerId,
            $userId,
            $surveyId
        );
        
        if ($result) {
            echo json_encode(["response"=>"success"]);
        } else {
            echo json_encode(["response"=>"failed"]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $surveyId = $_GET["id"];
    $questionsFormatted = [];
    $questions = $contents->getSurveyQuestions($surveyId);

    function formatAnswer($questionId)
    {
        $contents = new Contents();
        $answers = $contents->getSurveyAnswers($questionId);
        $answersFormatted = [];

        foreach ($answers as $answer) {
            $answerFormat = [
                "id" => $answer[2],
                "answer" => $answer[1]
            ];
            array_push($answersFormatted, $answerFormat);
        }

        return $answersFormatted;
    }

    foreach ($questions as $question) {
        $questionFormat = [
            "id" => $question[0],
            "question" => $question[1],
            "answers" => formatAnswer($question[0])
        ];

        array_push($questionsFormatted, $questionFormat);
    }
    echo json_encode(["response" => "a get request", "questions" => $questionsFormatted]);
}
