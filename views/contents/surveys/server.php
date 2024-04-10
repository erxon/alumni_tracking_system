<?php
include "/xampp/htdocs/thesis/models/Contents.php";

$contents = new Contents();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_POST["action"];

    if ($action == "create-survey") {
        $str = rand();
        $uniqueFilename = md5($str);
        $coverImage = "";

        //upload cover image
        if ($_FILES["coverImage"]["name"] != "") {
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

        $result = $contents->createSurvey($values);

        if ($result == 0) {
            echo json_encode(["response" => false]);
            die();
        }

        echo json_encode(["response" => true, "result" => $result]);
    }

    if ($action == "edit-survey") {
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

        echo json_encode(["response"=>$result]);
    }

    if ($action == "get-surveys") {
        $surveys = $contents->getSurveys();

        echo json_encode(["surveys" => $surveys]);
    }

    if ($action == "create") {

        $surveyId = (int) $_POST["surveyId"];
        $question = $_POST["question"];
        $numberOfAnswers = (int) $_POST["numberOfAnswers"];

        $questionId = $contents->createQuestion($surveyId, $question);
        $addAnswers = $contents->addAnswers($questionId, $numberOfAnswers);


        if ($questionId && $addAnswers) {
            echo json_encode(["response" => "success", "questionId" => $questionId, "answers" => $addAnswers]);
        } else {
            echo json_encode(["response" => "failed", "question" => $question, "numberOfAnswers" => $numberOfAnswers, "surveyId" => $surveyId, "questionId" => $questionId, "answers" => $addAnswers]);
        }
    }

    if ($action == "delete-survey") {
        $coverImage = $_POST["coverImage"];
        $result = $contents->deleteSurvey($_POST["id"]);

        unlink("/xampp/htdocs/thesis/public/images/cover/$coverImage");

        echo json_encode(["response" => $result]);
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
        $surveyId = $_POST["survey_id"];
        $userId = $_POST["user_id"];
        $questions = $_POST["questions"];


        for ($i = 0; $i < $questions; $i++) {
            $question = $_POST["question_$i"];
            $answer = $_POST["question_$question"];

            $result = $contents->vote(
                $question,
                $answer,
                $userId,
                $surveyId
            );

            if (!$result) {
                echo json_encode(["response" => "Something went wrong"]);
                die();
            }
        }

        echo json_encode(["response" => true, "numberOfVotes" => $contents->getVotes($surveyId)]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $surveyId = $_GET["id"];
    $questionsFormatted = [];
    $questions = $contents->getSurveyQuestions($surveyId);
    $surveyDetails = $contents->getSurvey($surveyId);

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
    echo json_encode(["response" => "a get request", "questions" => $questionsFormatted, "description" => $surveyDetails["description"]]);
}
