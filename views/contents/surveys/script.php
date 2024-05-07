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
                response.surveys.map((survey, index) => {
                    const date = formatDateAndTime(survey[4]);

                    $("#surveys-container").append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${survey[1]}</td>
                        <td>${date}</td>
                        <td>
                            <a href="/thesis/contents/surveys?id=${survey[0]}" class="btn btn-sm btn-dark">Details</a>
                            <a role="button" href="/thesis/contents/surveys/edit?id=${survey[0]}" class="btn btn-sm btn-outline-secondary"><i class="far fa-edit"></i></a>
                            <button onclick="deleteSurvey(${survey[0]})" data-bs-toggle="modal" data-bs-target="#delete-survey-confirm" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
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

        $(".action").prop("disabled", true);
        $(".action-link").addClass("disabled");
        $(`#spinner-${surveyId}`).show();
        
        $.ajax({
            type: "POST",
            url: "/thesis/contents/survey/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.response) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").append("Survey successfully deleted");
                    $("#response").addClass("text-bg-success");

                    toast.show();

                    setInterval(() => {
                        window.location = "/thesis/contents/surveys/all?page=1";
                    }, 3000);
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
                    $("#response").addClass("text-bg-success");
                    toast.show();
                }

            }
        })
    })

    $("#filter-table").on("change", (event) => {
        console.log(event.target.value)
        if (event.target.value !== "") {
            $("#filter-table-button").prop("disabled", false)

        } else {
            $("#filter-table-button").prop("disabled", true)
        }
    });

    $("#title").on("keyup", (event) => {
        if (event.target.value !== "") {
            $("#search-by-name").prop("disabled", false);
        } else {
            $("#search-by-name").prop("disabled", true);
        }
    });

    $("#reload-page").on("click", (event) => {
        window.location = "/thesis/contents/surveys/all?page=1";
    });
</script>