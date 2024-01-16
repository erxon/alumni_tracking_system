$("#survey-select").on("change", (event) => {
  console.log(event.target.value);

  if (event.target.value === "") {
    return;
  } else {
    $("#survey-container").empty();
    $.ajax({
      type: "GET",
      url: `/thesis/contents/home/edit/survey?id=${event.target.value}`,
      success: (response) => {
        const result = JSON.parse(response);
        $("#survey-container").append(`
                <div class="bg-white p-3">
                    <img class="mb-3" style="height: 200px; width: 100%; object-fit: cover" src="/thesis/public/images/cover/${result.coverImage}" />
                    <div class="p-2"><h5>${result.question}</h5>
                        <p class="text-secondary mr-2"><i class="far fa-clock"></i> ${result.dateCreated}</p>
                        <p>Survey by ${result.author}</p>
                        <a href="/thesis/contents/surveys?id=${event.target.value}" 
                            role="button" 
                            class="btn btn-sm btn-outline-dark">View</a>
                    </div>
                </div>
                `);
      },
    });
  }
});