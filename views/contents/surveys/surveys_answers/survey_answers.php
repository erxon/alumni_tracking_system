<?php session_start(); ?>
<?php
include("/xampp/htdocs/thesis/models/Contents.php");

$id = $_GET["id"];
$userId = $_SESSION["user_id"];

$contents = new Contents();
$survey = $contents->getSurveyQuestion($id);
$surveyAnswers = $contents->getSurveyAnswers($survey["id"]);
$surveyAnswered = false;
$surveyAnsweredMessage = "Thank you for answering this survey. Your response has been recored";

if ($contents->hasVoted($_SESSION["user_id"], $id)) {
    $surveyAnswered = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["answer"])) {
        $answerId = $_POST["answer"];

        $contents->surveyVote($userId, $id, $answerId);

        $surveyAnswered = true;
        header("Location: /thesis/surveys/answers?id=".$id);
    }

    if (isset($_POST["change_answer"])) {
        $surveyAnswered = false;
        //remove vote
        $contents->removeVote($userId, $id);
        header("Location: /thesis/surveys/answers?id=".$id);
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="shadow-sm survey-answer-form rounded bg-white">
        <div class="p-3">
            <p class="mb-3">Answer survey</p>
            <h3><?php echo $survey["question"]; ?></h3>
        </div>
        <img class="cover-image" src="/thesis/public/images/cover/<?php echo $survey["coverImage"]; ?>" />
        <?php if ($surveyAnswered) { ?>
            <form method="post">
                <div class="p-3">
                    <p class="fw-bold"><?php echo $surveyAnsweredMessage; ?></p>
                    <a role="button" class="btn btn-outline-dark btn-sm" href="/thesis/surveys/answers">Surveys</a>
                    <input name="change_answer" type="submit" class="btn btn-outline-dark btn-sm" value="Change Answer" />
                </div>
            </form>
        <?php } else { ?>
            <form class="p-3" method="post">
                <p class="fw-bold">Choices</p>
                <div class="d-flex">
                    <?php foreach ($surveyAnswers as $answer) { ?>
                        <div class="me-2">
                            <input id="<?php echo $answer[0]; ?>" name="answer" type="radio" class="form-check-input" value="<?php echo $answer[0]; ?>" />
                            <label for="<?php echo $answer[0]; ?>"><?php echo $answer[2]; ?></label>
                        </div>
                    <?php } ?>
                </div>
                <input role="button" class="btn btn-sm btn-dark mt-3" type="submit" value="Submit" />
            </form>
        <?php } ?>

    </div>
</div>

<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>