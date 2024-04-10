function update(result, id) {
  if (result) {
    const toast = new bootstrap.Toast("#response");
    toast.show();
    $("#toast-body").append(`<p>Alumni status was updated</p>`);
    $("#response").addClass("text-bg-primary");

    setInterval(() => {
      window.location = "/thesis/admin/registration";
    }, 3000);
  } else {
    $(`#unreg-alumni-details-${id}`)
      .append(`<div class="alert alert-danger mt-2" role="alert">
    Something went wrong
  </div>`);
  }
}

function approve(id) {
  // console.log(id);

  $(".decision-btn").prop("disabled", true);
  $("#loading").fadeIn();

  const data = new FormData();
  data.append("status", "active");

  $.ajax({
    type: "POST",
    url: `/thesis/admin/alumni?id=${id}`,
    dataType: "json",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      // console.log(response.result);
      update(response.result, id);
    },
  });
}

function decline(id, userAccountID) {
  
  $(".decision-btn").prop("disabled", true);
  $("#loading").fadeIn();

  const data = new FormData();
  data.append("delete", true);
  data.append("userAccountID", userAccountID);
  // console.log(userAccountID)

  $.ajax({
    type: "POST",
    url: `/thesis/admin/alumni?id=${id}`,
    dataType: "json",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      // console.log(response);
      update(response.result, id);
    },
  });
}

function showPopup(id) {
  $(`#unreg-alumni-details-${id}`).empty();
  $(`#unreg-alumni-details-${id}`).toggle();

  $.ajax({
    type: "GET",
    url: `/thesis/admin/alumni?id=${id}`,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: (response) => {
      $(`#unreg-alumni-details-${id}`).append(`
          <p class='mb-1 fw-semibold'>${response.firstName} ${response.lastName}</p>
          <p class='mb-0 text-secondary' style='font-size: 14px;'>${response.trackFinished}-${response.strandFinished}</p>
          <p class='text-secondary'>${response.dateGraduated}</p>
          <a role='button' href='/thesis/alumni?id=${response.id}' class='btn btn-sm btn-light w-100'>View</a>
        <div class='d-flex mt-1 gap-1'>
          <button onclick="approve(${id})" class='flex-fill btn btn-sm btn-dark'><i class="fas fa-check me-1"></i> Approve</button>
          <button onclick="decline(${id}, ${response.userAccountID})" class='flex-fill btn btn-sm btn-outline-dark'><i class="fas fa-times me-1"></i> Decline</button>
        </div>
      `);
    },
  });
}

$("#view-unreg-alum").on("click", () => {
  $(".unreg-alumni-details-popup").first().fadeIn("fast");
});
