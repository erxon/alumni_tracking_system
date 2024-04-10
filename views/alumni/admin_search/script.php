<script>
    $("#alumni-by-name").on("submit", (event) => {
        event.preventDefault();

        console.log(event);
        const data = new FormData(event.target);
        data.append("search", "byName");

        $.ajax({
            type: "POST",
            url: "/thesis/search/server/alumni",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#alumni-table-container").empty();
                response.result.map((alumni) => {
                    $("#alumni-table-container").append(`
                        <tr class="row-hover">
                            <td>${alumni[0]}</td>
                            <td><img class="avatar" src="/thesis/public/images/alumni/${alumni[2]}" /></td>
                            <td>${alumni[3]}</td>
                            <td>${alumni[4]}</td>
                            <td>${alumni[5]}</td>
                            <td>${alumni[6]}</td>
                            <td>${alumni[7]}</td>
                            <td>${alumni[20]}</td>
                            <td class="actions">
                                <a role="button" class="btn btn-sm btn-light alumni-record-action" href="/thesis/alumni?id=${alumni[0]}">View</a>
                                <button 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirm-delete" 
                                onclick="deleteAlumni(${alumni[0]})" 
                                role="button" 
                                class="btn btn-sm btn-danger alumni-record-action">Delete</button>
                                <div style="display: none;" id="loading_${alumni[0]}">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                `);
                })
            }
        })
    });

    $("#alumni-by-track-strand-year-grad").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append("search", "byTrackStrandYearGrad");

        $.ajax({
            type: "POST",
            url: "/thesis/search/server/alumni",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#alumni-table-container").empty();
                response.result.map((alumni) => {
                    $("#alumni-table-container").append(`
                        <tr class="row-hover">
                            <td>${alumni[0]}</td>
                            <td><img class="avatar" src="/thesis/public/images/alumni/${alumni[2]}" /></td>
                            <td>${alumni[3]}</td>
                            <td>${alumni[4]}</td>
                            <td>${alumni[5]}</td>
                            <td>${alumni[6]}</td>
                            <td>${alumni[7]}</td>
                            <td>${alumni[20]}</td>
                            <td class="actions">
                                <a role="button" class="btn btn-sm btn-light alumni-record-action" href="/thesis/alumni?id=${alumni[0]}">View</a>
                                <button 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirm-delete" 
                                onclick="deleteAlumni(${alumni[0]})" 
                                role="button" 
                                class="btn btn-sm btn-danger alumni-record-action">Delete</button>
                                <div style="display: none;" id="loading_${alumni[0]}">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                `);
                })

            }

        })

    })

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
</script>