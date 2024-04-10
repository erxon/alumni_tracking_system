<?php
session_start();
include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$contents = new Contents();
$stringUtil = new StringUltilities();
$surveys = $contents->getSurveys();
$userId = $_SESSION["user_id"];

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding surveys" style="margin-top: 5%">
    <h1 class="mb-3">Surveys</h1>
    <div class="row">
        <?php foreach ($surveys as $survey) {
        ?>
            <input hidden id="survey-id" value="<?php echo $survey[0] ?>" />
            <div class="col-4">
                <div class="card">
                    <img class="card-img-top" style="object-fit: cover; margin-bottom: 0" src="/thesis/public/images/cover/<?php echo $survey[5]; ?>">
                    <div class="p-3">
                        <h5 class="card-title">
                            <?php echo $survey[1] ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $stringUtil->dateAndTime($survey[4]); ?>
                        </p>
                        <?php if ($contents->hasVoted($userId, $survey[0])) { ?>
                            <p style="font-size: 14px;" class="m-0 mb-3 text-success">You have already responed to this survey</p>
                        <?php } ?>
                        <p id="survey-answered-<?php echo $survey[0]; ?>" style="font-size: 14px; display: none" class="m-0 mb-3 text-success">You have already responed to this survey</p>
                        <button id="survey_<?php echo $survey[0] ?>" <?php if ($contents->hasVoted($userId, $survey[0])) {
                                                                            echo "disabled";
                                                                        } ?> onclick="viewQuestions('<?php echo $survey[0]; ?>', '<?php echo $survey[1]; ?>')" data-bs-toggle="modal" data-bs-target="#answers-modal" class="btn btn-sm btn-dark">
                            Answer survey <span id="number-of-votes-<?php echo $survey[0] ?>" class="badge text-bg-secondary"><?php echo $contents->getVotes($survey[0]); ?></span></button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="answers-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="survey-question-title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="height: 256px; overflow-y: auto" class="p-3" id="survey-text"></div>
            <form class="survey-question-form">
                <input hidden name="user_id" value="<?php echo $userId ?>" />
                <div class="p-3" id="survey-question-form-container"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button data-bs-dismiss="modal" type="submit" class="btn btn-primary">Submit</button>
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
            url: "/thesis/contents/survey/server",
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

    let surveyId = ""

    function viewQuestions(survey, surveyTitle) {
        surveyId = survey;
        $("#survey-question-form-container").empty();
        $.ajax({
            type: "GET",
            url: `/thesis/contents/server/survey?id=${survey}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                console.log(parsedResponse);

                
                $("#survey-text").empty();
                $("#survey-text").append(parsedResponse.description);
                
                $("#survey-question-title").empty();
                $("#survey-question-title").append(surveyTitle);

                $("#survey-question-form-container").append(`
                        <input hidden name="survey_id" value="${survey}" />
                        <input hidden name="questions" value="${parsedResponse.questions.length}" />
                    `);

                parsedResponse.questions.map((question, index) => {
                    $("#survey-question-form-container").append(`
                        <input hidden name="question_${index}" value="${question.id}" />
                        <h5>${index + 1}. ${question.question}<h5>
                    `);

                    question.answers.map((answer) => {
                        $("#survey-question-form-container").append(`
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    value="${answer.id}" 
                                    name="question_${question.id}" 
                                    id="${answer.id}" />
                                <label class="form-check-label" for="${answer.id}">
                                    ${answer.answer}
                                </label>
                            </div>  
                        `)
                    });
                    $("#survey-question-form-container").append(`
                        <hr />
                    `);
                })
            }
        })
    }



    $(".survey-question-form").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append("action", "vote");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response)
                if (response.response) {
                    $("#toast-body").empty();

                    $(`#number-of-votes-${surveyId}`).empty();
                    $(`#number-of-votes-${surveyId}`).append(response.numberOfVotes);

                    $(`#survey-answered-${surveyId}`).show();

                    const toast = new bootstrap.Toast("#response");

                    $("#toast-body").append("Survey answered");
                    $("#response").addClass("text-bg-success");

                    toast.show();

                    $(`#survey_${surveyId}`).prop("disabled", true);
                }
            }
        });
    });
</script>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>