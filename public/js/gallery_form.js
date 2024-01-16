let galleryId = "";

$("#gallery-selection").on("change", (event) => {
  if (event.target.value != "") {
    $("#upload-photo-container").show();
    galleryId = event.target.value;
  } else {
    $("#upload-photo-container").hide();
  }
});

$("#new-gallery").on("keyup", (event) => {
  if (event.target.value !== "") {
    $("#add-gallery-button").prop("disabled", false);
  } else {
    $("#add-gallery-button").prop("disabled", true);
  }
});

$("#upload-image-gallery").on("submit", (event) => {
  event.preventDefault();

  const data = new FormData(event.target);
  data.append("gallery_id", galleryId);

  $.ajax({
    type: "POST",
    url: "/thesis/contents/gallery/imageupload",
    data: data,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
        console.log(response.response)
      let toast = new bootstrap.Toast(document.getElementById("response"));
      $("#toast-body").html(response.response);
      toast.show();

      $("#upload-image-gallery")[0].reset();
    },
  });
});
