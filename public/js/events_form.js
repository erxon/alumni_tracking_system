$("#events-form").on("submit", (event) => {
  event.preventDefault();
  $("#events-form").addClass("was-validated");

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();
  data.append("body", content);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/events/submit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.success);
      toast.show();

      $("#events-form")[0].reset();
      $("#events-form").removeClass("was-validated");
    }
  }).fail(() => {
    console.log("error")
  })
});

$("#events-form-edit").on("submit", (event) => {
  event.preventDefault();
  event.preventDefault();
  $("#events-form-edit").addClass("was-validated");

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();
  data.append("body", content);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/events/edit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.success);
      toast.show();

      $("#events-form-edit").removeClass("was-validated");
    },
  });
});
