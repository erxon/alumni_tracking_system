let currentAnswers = [];

let answersInContainer = $("#edit-answers-container").find("li");
for (let i = 0; i < answersInContainer.length; i++) {
  currentAnswers.push($(`#answer${i + 1}`).text());
}

$("#edit-surveys-add-answer").on("click", () => {
  let newAnswer = $("#edit-surveys-answer").val();

  if (newAnswer === "") {
    return;
  } else {
    $("#edit-surveys-answer").val("");
    $("#edit-answers-container").empty();

    currentAnswers.push(newAnswer);

    currentAnswers.map((answer, index) => {
      $("#edit-answers-container").append(`
      <div class="answer">
        <li>${answer}</li>
        <button onclick="deleteSurveyAnswer(${index})" class="remove-answer btn btn-sm btn-light">remove</button>
      </div>
      `);
    });
  }
});

$("#edit-surveys-form").on("submit", (event) => {
  event.preventDefault();

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();

  data.append("body", content);
  console.log(currentAnswers);
  data.append("answers", currentAnswers.length);

  currentAnswers.map((answer, index) => {
    data.append(`answer${index + 1}`, answer);
  });

  $.ajax({
    type: "POST",
    url: "/thesis/contents/surveys/edit/submit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.response);
      toast.show();

      $("#edit-surveys-form").removeClass("was-validated");
    },
  });
});

function deleteSurveyAnswer(index) {
  currentAnswers = [
    ...currentAnswers.filter((answer, i) => {
      return i !== index;
    }),
  ];

  $("#edit-answers-container").empty();

  currentAnswers.map((answer, index) => {
    $("#edit-answers-container").append(`
        <div class="answer">
          <li>${answer}</li>
          <button onclick="deleteSurveyAnswer(${index})" class="remove-answer btn btn-sm btn-light">remove</button>
        </div>
        `);
  });
}
