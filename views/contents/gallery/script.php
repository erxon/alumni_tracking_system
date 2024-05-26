<script>
    const modal = new bootstrap.Modal("#delete-gallery-confirmation");
    let galleryToDelete = ""


    function deleteGallery(id) {
        modal.show();
        galleryToDelete = id;
    }

    function getGalleries() {
        $.ajax({
            type: "GET",
            url: "/thesis/contents/server/gallery",
            success: (response) => {
                console.log(response)
                const parsedResponse = JSON.parse(response);
                parsedResponse.response.map((gallery, index) => {
                    const date = formatDateAndTime(gallery[3]);
                    $("#galleries-container").append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${gallery[1]}</td>
                        <td>${date}</td>
                        <td>${gallery[2]}</td>
                        <td>
                            <a role="button" href="/thesis/contents/gallery?id=${gallery[0]}" class="btn btn-sm btn-dark">See images</a>
                            <button onclick="alumniInfo('${gallery[1]}', 
                            '${gallery[0]}', 
                            '/thesis/contents/gallery?id=' . ${gallery[0]}',
                            '${gallery[2]}')" data-bs-toggle="modal" data-bs-target="#send-email" class="btn btn-sm btn-dark">Send email</button>
                            <a role="button" href="/thesis/contents/gallery/edit?id=${gallery[0]}" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></a>
                            <button onclick="deleteGallery('${gallery[0]}')" data-bs-toggle="modal" data-bs-target="#delete-gallery-confirmation" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    `)
                })
            }
        });
    }


    $("#confirm-delete").on("click", () => {
        console.log(galleryToDelete)

        const data = new FormData();

        data.append("action", "delete");
        data.append("id", galleryToDelete);

        $(".action").prop("disabled", true);
        $(".action-link").addClass("disabled");
        $(`#spinner-${galleryToDelete}`).show();
        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/gallery",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.result) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").empty();
                    $("#toast-body").append("Gallery successfully deleted");
                    $("#response").addClass("text-bg-success");

                    toast.show();

                    setInterval(() => {
                        window.location = "/thesis/contents/gallery/all?page=1";
                    }, 3000);
                }
                console.log(response);
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
        window.location = "/thesis/contents/gallery/all?page=1";
    });
</script>