let answers = [];

$("#surveys-add-answer").on("click", () => {
  let answer = $("#surveys-answer").val();

  if (answer === "") {
    return;
  } else {
    answers = [...answers, answer];
    $("#surveys-answer").val("");
    //empty the container
    $("#answers-container").empty();

    //add an item to the display
    answers.map((item, index) => {
      $("#answers-container").append(`<p>${index + 1}. ${item}</p>`);
    });
  }
});

$("#surveys-form").on("submit", (event) => {
  event.preventDefault();

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();

  data.append("body", content);
  data.append("answers", answers.length);
  answers.map((answer, index) => {
    data.append(`answer${index + 1}`, answer);
  });

  $.ajax({
    type: "POST",
    url: "/thesis/contents/surveys/submit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.response);
      toast.show();

      $("#surveys-form")[0].reset();
      $("#answers-container").empty();
      $("#surveys-form").removeClass("was-validated");
    },
  });
});
