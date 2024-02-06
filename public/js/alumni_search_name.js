function select(firstName, middleName, lastName) {
  console.log("selected");
  $("#name-search-firstName").val(firstName);
  $("#name-search-middleName").val(middleName);
  $("#name-search-lastName").val(lastName);
  $("#alumni-name-search").val(`${firstName} ${middleName} ${lastName}`);
}

$("#alumni-name-search").keyup(() => {
  const name = $("#alumni-name-search").val();

  if (!$("#search-result-container").is(":empty")) {
    $("#search-result-container").empty();
  }

  $.ajax({
    type: "GET",
    url: `/thesis/searchname?name=${name}`,
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      if (!Object.is(response, "null")) {
        const result = JSON.parse(response);

        $("#search-result-container").append(`
                <div class="d-flex align-items-center bg-white rounded p-2">
                    <p class="mb-0 me-2">${result.firstName} ${result.middleName} ${result.lastName}</p>
                    <button type="button" onclick="select('${result.firstName}', '${result.middleName}', '${result.lastName}')"
                    class="btn btn-sm btn-outline-dark">Select</button>
                </div>`);
      }
    },
  });
});
