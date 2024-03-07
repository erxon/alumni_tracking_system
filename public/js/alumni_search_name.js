$("#alumni-name-search").keyup(() => {
  const name = $("#alumni-name-search").val();

  if (!$("#search-result-container").is(":empty")) {
    $("#search-result-container").empty();
    $("#search-result-container").removeClass();
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
                <div class="d-flex align-items-center bg-white rounded p-2 mt-3">
                    <p class="mb-0 me-2">${result.firstName} ${result.middleName} ${result.lastName}</p>
                    <a href="/thesis/alumni?id=${result.id}">View</a>
                </div>`);
      }
    },
  });
});

$("#search").on("submit", (event) => {
  event.preventDefault();

  //if batch is not empty and batch < 2000 and > the current year, input is invalid
  const alumniBatch = $("#alumni-batch").val();
  const currentYear = new Date().getFullYear();


  $("#alumni-batch").removeClass("border border-danger");
  
  if (alumniBatch !== "") {
    if (Number(alumniBatch) < 2000 || Number(alumniBatch) > currentYear) {
      $("#alumni-batch").addClass("border border-danger");
      return;
    }
  }

  const formData = new FormData(event.target);

  $.ajax({
    type: "POST",
    data: formData,
    url: `/thesis/alumni/search`,
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      const parseResponse = JSON.parse(response);

      $("#search-result-container").empty();
      $("#search-result-container").removeClass();

      if (parseResponse.success) {
        $("#search-result-container").addClass("rounded bg-white p-2 mt-3");
        $("#search-result-container").append(
          `<h3 class="text-secondary">Results</h3>`
        );
        parseResponse.response.map((data, index) => {
          return $("#search-result-container").append(`<div class="d-flex">
            <p class="me-2">${index + 1}</p>
            <p class="me-2">${data[3]}</p>
            <p class="me-2">${data[4]}</p>
            <p class="me-2">${data[5]}</p>
            <a class="me-2" href="/thesis/alumni?id=${data[0]}">view</a>
          </div>`);
        });
      } else {
        $("#search-result-container").append(
          `<p class="text-secondary mt-3">${parseResponse.response}</p>`
        );
      }
    },
  });
});
