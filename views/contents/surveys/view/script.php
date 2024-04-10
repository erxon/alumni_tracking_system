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
            url: "/thesis/contents/survey/server",
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
            url: "/thesis/contents/survey/server",
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
            url: "/thesis/contents/survey/server",
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