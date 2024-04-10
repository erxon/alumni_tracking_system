<script>
    const modal = new bootstrap.Modal("#image-full");

    let imageToDelete = "";
    let imageName = "";

    function imageFull(imageAddress) {
        $("#image-container").empty();
        $("#image-container").append(`
            <img style="width: 100%; height: 100%" src="${imageAddress}" />
        `);

        modal.show();
    }

    function deleteImage(id, image) {
        imageToDelete = id;
        imageName = image;

        console.log(imageToDelete)
    }

    $("#delete-image").on("click", () => {
        console.log(imageToDelete)

        const data = new FormData();

        data.append("action", "delete-image");
        data.append("id", imageToDelete);
        data.append("imageName", imageName);

        $(`#image_${imageToDelete}`).prop("hidden", true);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/gallery",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                $("#toast-body").empty();
                if (response.result) {
                    const toast = new bootstrap.Toast("#response");
                    $("#toast-body").append("Image successfully deleted");
                    $("#response").addClass("text-bg-primary");
                    toast.show();
                } else {
                    $("#toast-body").append("Something went wrong");
                    $("#response").addClass("text-bg-danger");
                }
            }
        })

    });

    $("#upload-image-gallery").on("submit", (event) => {
        event.preventDefault();
        console.log(event);

        const data = new FormData(event.target);
        data.append("action", "upload-image");
        data.append("id", $("#gallery-id").val());

        $.ajax({
            type: "POST",
            url: "/thesis/contents/server/gallery",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const toast = new bootstrap.Toast("#response");
                if (response.image) {
                    $("#image-gallery").append(`<div id="image_${response.id}" class="col-sm-6 col-md-4">
                        <div class="card mb-2">
                            <img onclick="imageFull('/thesis/public/images/gallery/${response.image}')" style="cursor: pointer;" class="image card-img-top" style="height: 300px; object-fit: contain;" src="/thesis/public/images/gallery/${response.image}" />
                            <div class="card-body">
                                <p class="card-text">${response.image}</p>
                                <p class="card-text text-secondary">New</p>
                            </div>
                        </div>
                    </div>`);

                    $("#toast-body").append(response.response);
                    $("#response").addClass("text-bg-success");
                    toast.show();
                } else {
                    $("#toast-body").append(response.response);
                    $("#response").addClass("text-bg-primary");
                    toast.show();
                }
            }
        });
    })
</script>