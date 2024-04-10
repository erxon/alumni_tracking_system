<script>
    let galleryId = "";
    $("#upload-image-gallery").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append("gallery_id", galleryId);

        $.ajax({
            type: "POST",
            url: "/thesis/contents/gallery/imageupload",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response.response)
                let toast = new bootstrap.Toast(document.getElementById("response"));
                $("#toast-body").html(response.response);
                $("#response").addClass("text-bg-primary");
                toast.show();

                $("#upload-image-gallery")[0].reset();
            },
        });
    });
</script>