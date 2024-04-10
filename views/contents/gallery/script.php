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
                parsedResponse.response.map((gallery) => {
                    console.log(gallery[3])
                    $("#galleries-container").append(`
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="far fa-folder"></i> ${gallery[1]}</h5>
                                <p style="font-size: 14px" class="card-text"><i class="far fa-clock"></i> ${formatDateAndTime(gallery[3])}</p>
                                <p class="fw-light" style="font-size: 14px; height: 50px;">${gallery[2]}</p>
                                <div class="d-flex">
                                    <div class="w-100">
                                        <a role="button" href="/thesis/contents/gallery?id=${gallery[0]};" class="btn btn-sm btn-dark">See images</a>
                                    </div>
                                    <a role="button" href="/thesis/contents/gallery/edit?id=${gallery[0]};" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></a>
                                    <button onclick="deleteGallery('${gallery[0]}')" data-bs-toggle="modal" data-bs-target="#delete-gallery-confirmation" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    $("#galleries-container").empty()

                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").empty();
                    $("#toast-body").append("Gallery successfully deleted");
                    $("#response").addClass("text-bg-primary");

                    toast.show();
                    getGalleries();
                }
                console.log(response);
            }
        })
    })
</script>