<?php
session_start();
include ("/xampp/htdocs/thesis/models/Contents.php");
include ("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$contents = new Contents();
$stringUtil = new StringUltilities();
$surveys = $contents->getSurveys();
$userId = $_SESSION["user_id"];

include ("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding surveys" style="margin-top: 48px">
    <h3>Surveys</h3>
    <?php foreach ($surveys as $survey) {
        ?>
        <div class="bg-white shadow d-flex rounded flex-row survey mb-3">
            <img style="height: 100%; width: 50%; object-fit: cover; margin-bottom: 0"
                src="/thesis/public/images/cover/<?php echo $survey[6]; ?>" class="card-img-top">
            <div class="p-4">
                <h5 class="mb-1">
                    <?php echo $survey[1] ?>
                </h5>
                <p class="text-secondary mb-0">
                    <?php echo $stringUtil->dateAndTime($survey[4]); ?>
                </p>
                <p class="card-text">
                    <?php echo $survey[2]; ?>
                </p>
                <div class="d-flex flex-row" style="overflow-x: auto; width: 450px;">
                    <?php
                    $questions = $contents->getSurveyQuestions($survey[0]);
                    foreach ($questions as $question) {
                        $hasVoted = $contents->hasVoted($userId, $question[0]);
                        ?>
                        <div class="col-6 rounded p-2 me-2 question-card bg-light">
                            <p class="m-0 fw-semibold">
                                <?php echo $question[1]; ?>
                            </p>
                            <?php $numberOfVotes = $contents->getVotes($question[0]); ?>
                            <p style="font-size: 14px;"><?php echo $numberOfVotes ?> voted</p>
                            
                            <?php if ($hasVoted) { ?>
                                <p class="text-secondary" style="font-size: 14px">You've already voted in this question</p>
                                <button disabled class="btn btn-sm btn-dark">vote</button>
                            <?php } else { ?>
                                <button data-bs-toggle="modal" data-bs-target="#answers-modal"
                                    onclick="openQuestion('<?php echo $question[0] ?>', '<?php echo $question[1] ?>', <?php echo $survey[0] ?>)"
                                    class="btn btn-sm btn-dark">vote</button>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="modal fade" id="answers-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 survey-question-title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="survey-question-form">
                <input style="display: none;" name="user_id" value="<?php echo $userId; ?>" />
                <input style="display: none;" class="survey-question-id" name="survey_question_id" value="" />
                <div class="modal-body survey-question-answers">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let survey = 0;
    function openQuestion(questionId, questionTitle, surveyId) {
        $(".survey-question-answers").empty();
        $(".survey-question-title").empty();
        survey = surveyId;
        const data = new FormData();

        data.append("action", "get-answers");
        data.append("question_id", questionId);

        $(".survey-question-title").append(questionTitle);
        $(".survey-question-id").val(questionId);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/survey",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response.answers);
                response.answers.map((answer) => {
                    $(".survey-question-answers").append(`
                        <div class='form-check'>
                            <input class='form-check-input' name="survey_answer" id="${answer[2]}" type="radio" value="${answer[2]}" />
                            <label class="form-check-label" for="${answer[2]}">
                                ${answer[1]}
                            </label>
                        </div>
                    `);
                })

            }
        });
    }

    $(".survey-question-form").on("submit", (event) => {
        event.preventDefault();
        //questionid, surveyid, userid, answerid

        const data = new FormData(event.target);
        data.append("survey_id", survey);
        data.append("action", "vote");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/survey",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if(response.response === "success"){
                    location.reload();
                }
            }
        })

    });
</script>


<?php include ("/xampp/htdocs/thesis/views/template/footer.php"); ?>