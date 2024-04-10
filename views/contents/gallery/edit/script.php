<script>
    $(".gallery-field").on("keyup", () => {
        console.log("keyup")

        $("#save-changes").prop("disabled", false);
    })

    $("#edit-gallery").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);

        data.append("action", "edit");
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
                $("#toast-body").empty();
                const toast = new bootstrap.Toast("#response");
                if (response.result) {
                    $("#toast-body").append("Gallery successfully updated");
                    $("#response").addClass("text-bg-success");
                    toast.show();
                } else {
                    $("#toast-body").append("Failed on updating gallery");
                    $("#response").addClass("text-bg-danger");
                    toast.show();
                }

                $("#save-changes").prop("disabled",true);

            }
        })
    })
</script>