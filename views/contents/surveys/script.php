<script>
    let surveyId = "";

    function deleteSurvey(survey) {
        surveyId = survey;
    }

    function getSurveys() {
        const data = new FormData();

        data.append("action", "get-surveys");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#surveys-container").empty();
                response.surveys.map((survey) => {
                    const date = formatDateAndTime(survey[4]);

                    $("#surveys-container").append(`
                    <div class="col-4">
                        <div class="card">
                            <img style="height: 7rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/${survey[5]}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title m-0">${survey[1]}</h5>
                                <p style="font-size: 14px;" class="m-0">${date}</p>
                            </div>
                            <div class="card-footer d-flex">
                                <div class="w-100"><a href="/thesis/contents/surveys?id=${survey[0]}" class="btn btn-sm btn-dark">Details</a></div>
                                <a role="button" href="/thesis/contents/surveys/edit?id=${survey[0]}" class="btn btn-sm btn-outline-secondary me-2"><i class="far fa-edit"></i></a>
                                <button onclick="deleteSurvey(${survey[0]})" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete-survey-confirm" 
                                    class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    `);
                })
            }
        })
    }

    $("#confirm-survey-delete").on("click", () => {
        const data = new FormData();

        data.append("action", "delete-survey");
        data.append("id", surveyId);
        data.append("coverImage", $(`#cover-image-${surveyId}`).val());

        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response)
                if (response.response) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").append("Survey successfully deleted");
                    $("#response").addClass("text-bg-primary");
                    toast.show();

                    getSurveys();
                }
            }
        })
    });

    $("#surveys-form").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);

        var description = tinymce.get("content-body").getContent();
        data.append("action", "create-survey");
        data.append("description", description);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (!response.response) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").append("Something went wrong");
                    $("#response").addClass("text-bg-danger");
                    toast.show();
                } else {
                    window.location = `/thesis/contents/surveys?id=${response.result}`
                }

            }
        })
    });

    $("#edit-surveys-form").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        var description = tinymce.get("content-body").getContent();

        data.append("action", "edit-survey");
        data.append("description", description);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response)
                if (response.response) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").append("Survey updated");
                    $("#response").addClass("text-bg-primary");
                    toast.show();
                }

            }
        })
    })
</script>