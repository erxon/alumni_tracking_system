$("#news-form").on("submit", (event) => {
  event.preventDefault();
  $("#news-form").addClass("was-validated");

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();
  data.append("body", content);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/news/submit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.success);
      toast.show();

      $("#news-form")[0].reset();
      $("#news-form").removeClass("was-validated");
    },
  });
});

$("#news-form-edit").on("submit", (event) => {
  event.preventDefault();
  event.preventDefault();
  $("#news-form-edit").addClass("was-validated");

  let data = new FormData(event.target);
  var content = tinymce.get("content-body").getContent();
  data.append("body", content);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/news/edit",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.success);
      toast.show();

      $("#news-form-edit").removeClass("was-validated");
    },
  });
});
