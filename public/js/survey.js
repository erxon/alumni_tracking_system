$("#survey-answer-form").on("submit", (event) => {
  event.preventDefault();

  $data = new FormData(event.target);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/survey/answer",
    data: $data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.message);
      toast.show();
    },
  });

  $("#survey-answer-form").empty();
  $("#survey-answer-form").append(
    `<div>Thank you for answering this survey </div>`
  );
});
