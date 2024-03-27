<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

$id = $_GET["id"];

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$survey = $content->getSurvey($id);
$questions = $content->getSurveyQuestions($id);
$stringUtil = new StringUltilities();

if (isset($_POST["delete-action"])) {
    $result = $content->deleteSurvey($id);

    if ($result) {
        header("Location: /thesis/contents/surveys/all");
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>

<input style="display: none;" id="survey-id" value="<?php echo $id; ?>" />
<div class="main-body-padding admin-views">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents/surveys/all">Surveys</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $survey["title"] ?></li>
        </ol>
    </nav>
    <div class="row m-auto">
        <div class="mb-3">
            <div class="d-flex align-items-center">
                <h5 class="m-0 me-2"><?php echo $survey["title"] ?></h5>
                <?php if (
                    isset($_SESSION["type"]) &&
                    $_SESSION["type"] == "admin" &&
                    $_SESSION["user_id"] ==
                    $survey["author"]
                ) { ?>
                    <a role="button" href="/thesis/contents/surveys/edit?id=<?php echo $survey["id"]; ?>" class="btn btn-sm btn-light me-1"><i class="fas fa-pen"></i></a>
                    <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#on-delete-confirm"><i class="fas fa-trash"></i></button>
                <?php } ?>
            </div>
            <p class="label mb-0">Created on <?php
                                                $dateCreated = $stringUtil->dateAndTime($survey["dateCreated"]);
                                                echo $dateCreated;
                                                ?></p>
        </div>
        <div class="col-lg-8">
            <!--Survey body-->
            <img class="mb-3" style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey["coverImage"] ?>" />
            <?php echo $survey["description"] ?>
        </div>
        <div class="col-lg-4">
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <p class="fw-bold m-0">Questions</p>
                <button data-bs-toggle="modal" data-bs-target="#add-new-question" class="btn btn-sm btn-dark ms-auto"><i class="fas fa-plus me-2"></i> Add</button>
            </div>

            <?php if (count($questions) == 0) { ?>
                <p class="text-secondary">No questions yet</p>
            <?php } else { ?>
                <div style="overflow-y: scroll; height: 475px;" class="p-2">
                    <?php foreach (array_reverse($questions) as $question) {
                        $answers = $content->getSurveyAnswers($question[0]);
                    ?>
                        <div class="p-3 rounded bg-white shadow-sm mb-3">

                            <p class="m-0 mb-3"><?php echo $question[1] ?></p>
                            <div style="font-size: 14px;">
                                <p class="border-bottom">Answers</p>
                                <ul>
                                    <?php foreach ($answers as $answer) { ?>
                                        <li><?php echo $answer[1]; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <button data-bs-target="#edit-question" data-bs-toggle="modal" class="btn btn-sm btn-primary">Edit</button>
                            <?php include "survey_question_edit.php"; ?>
                            <button onclick="deleteQuestion(<?php echo $question[0] ?>)" class="btn btn-sm btn-secondary" type="submit">Delete</button>

                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
</div>



<div class="modal fade" id="add-new-question" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add-question-form" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!--Question-->
                    <input hidden name="surveyId" value="<?php echo $id ?>" />
                    <input class="form-control mb-1" name="question" placeholder="Question" required />
                    <!--Answer-->
                    <div class="d-flex mb-3">
                        <input id="answer" class="form-control me-2 flex-fill" name="answer" value="" placeholder="Answer" />
                        <button id="add-answer" type="button" class="btn btn-sm btn-light flex-fill"><i class="fas fa-plus"></i></button>
                    </div>
                    <!--Answer List-->
                    <p id="add-answer-validation" style="display: none" class="m-0 text-danger">You should have at least 2 answers</p>
                    <div id="answer-list-container"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<form method="post">
    <input hidden name="delete-action" value="delete" />
    <div class="modal fade" id="on-delete-confirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this survey?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    let answer = [];
    let answerContainer = $("#answer-list-container");
    let questions = [];

    window.onload = () => {
        const surveyId = $("#survey-id").val();
        $.ajax({
            type: "GET",
            url: `/thesis/contents/server/survey?id=${surveyId}`,
            success: (response) => {
                console.log(response);
                //parse questions
                const parsedResponse = JSON.parse(response);
                questions = parsedResponse.questions;
            }
        });
    }

    function removeAnswer(targetIndex) {
        console.log(targetIndex)
        answer.splice(targetIndex, 1);

        answerContainer.empty();

        answer.map((value, index) => {
            answerContainer.append(`
                <div class="d-flex mb-2">
                    <input class="form-control me-2" value="${value}" readonly/>
                    <button onclick="removeAnswer('${index}')" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                </div>
            `);
        });
    }

    $("#add-answer").on("click", () => {
        if ($("#answer").val() === "") {
            return;
        }

        answer.push($("#answer").val());
        answerContainer.empty();

        answer.map((value, index) => {
            answerContainer.append(`
                <div class="d-flex mb-2">
                    <input name="answer_${index}" class="form-control me-2" value="${value}" readonly />
                    <button onclick="removeAnswer(${index})" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                </div>
            `);
        });

        $("#answer").val("");
    });

    $("#add-question-form").on("submit", (event) => {
        event.preventDefault();

        $("#add-question-form").addClass("was-validated");

        if (answer.length < 2) {
            $("#add-answer-validation").show();
            return;
        }

        const data = new FormData(event.target);

        data.append("action", "create");
        data.append("numberOfAnswers", answer.length);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/survey",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,

            success: (response) => {
                console.log(response);
                if (response.response === "success") {
                    location.reload();
                }
            }
        });
    });

    function editRemoveAnswer(questionId, answerId) {
        const editAnswerListContainer = $("#edit-answer-list-container");
        editAnswerListContainer.empty();

        //find the question
        const question = questions.find((value) => {
            return value.id === questionId;
        });
        console.log(question)
        //delete the answer
        question.answers = question.answers.filter((value) => {
            return value.id !== answerId;
        });

        question.answers && question.answers.map((answerValue, index) => {
            editAnswerListContainer.append(`
                    <div class="d-flex mb-2">
                        <input name="answer_${index}" class='form-control me-2' value='${answerValue.answer}' readonly />
                        <button onclick="editRemoveAnswer('${questionId}', '${answerValue.id}')" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                    </div>
                    `);
        })
    }

    function editQuestionRemoveAnswer(targetIndex, questionId) {
        const editAnswerListContainer = $("#edit-answer-list-container");
        editAnswerListContainer.empty();

        let question = questions.find((object) => {
            return object.id === String(questionId);
        });

        console.log(question);

        question.answers.splice(targetIndex, 1);
        question.answers.map((object, index) => {
            editAnswerListContainer.append(`
            <div class="d-flex mb-2">
                    <input name="answer_${index}" class="form-control me-2" value="${object.answer}" readonly />
                    <button onclick="editQuestionRemoveAnswer('${index}', ${questionId})" type="button" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                </div>
            `);
        })
    }

    $("#edit-question-add-answer").on("click", () => {
        const answer = $("#edit-question-answer").val();
        const editAnswerListContainer = $("#edit-answer-list-container");
        editAnswerListContainer.empty();

        if (answer.length === 0) {
            return;
        }

        const questionId = $("#edit_question_question_id").val();
        //create a copy of the answers of the question
        const question = questions.find((object) => {
            return object.id === questionId;
        });

        let answers = question.answers;

        answers.push({
            answer: answer
        });

        question.answers = answers;

        //append in answer list all of the answers
        question.answers.map((value, index) => {
            editAnswerListContainer.append(`
            <div class="d-flex mb-2">
                    <input name="answer_${index}" class="form-control me-2" value="${value.answer}" readonly />
                    <button onclick="editQuestionRemoveAnswer('${index}', ${questionId})" type="button" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                </div>
            `);
        });

        $("#edit-question-answer").val("");
    });


    $("#edit-question-form").on("submit", (event) => {
        event.preventDefault();
        $("#edit-question-form").addClass("was-validated");

        const action = "edit";
        const questionId = $("#edit_question_question_id").val();

        const question = questions.find((object) => {
            return object.id === questionId;
        });

        const answers = question.answers;

        if (answers.length < 2) {
            $("#edit-answer-validation").show();
            return;
        }

        const data = new FormData(event.target);
        console.log(answers)

        data.append("action", action);
        data.append("numberOfAnswers", answers.length);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/survey",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response === "success") {
                    location.reload();
                }
            }
        })
    });

    function deleteQuestion(questionId) {

        const data = new FormData();

        data.append("question_id", questionId);
        data.append("action", "delete");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/survey",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response)
                if (response.response === "success") {
                    location.reload();
                }
            }
        });
    }
</script>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>