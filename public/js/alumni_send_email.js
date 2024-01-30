$("#content").keyup(() => {
  if ($("#content").val() !== "") {
    $("#send-email-button").prop("disabled", false);
  } else {
    $("#send-email-button").prop("disabled", true);
  }
});

$("#send-email-form").on("submit", (event) => {
  event.preventDefault();

  const formData = new FormData(event.target);

  $("#loading").prop("hidden", false);
  $("#send-email-button").prop("disabled", true);

  $.ajax({
    type: "POST",
    url: "/thesis/email",
    data: formData,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      $("#alert").prop("hidden", false);
    
      if (response.sent) {
        $("#alert").addClass("alert-success");
        $("#send-email-form")[0].reset();
      } else {
        $("#alert").addClass("alert-danger");
      }

      
      $("#loading").fadeOut();
      $("#alert").append(
        `<div><i class="far fa-envelope"></i> ${response.response}</div>`
      );
      setTimeout(() => {
        $("#alert").fadeOut();
      }, 3000);
    },
  });
});
