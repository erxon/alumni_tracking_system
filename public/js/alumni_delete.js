$("#delete-reason").keyup((event) => {
  if (event.target.value !== "") {
    $("#confirm-alumni-delete-button").prop("disabled", false);
  } else {
    $("#confirm-alumni-delete-button").prop("disabled", true);
  }
});
