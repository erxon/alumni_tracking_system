<script>
    $("#cover-image").on("change", (event) => {
        const inputImage = event.target.files[0];
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(event.target.value)) {
            const toast = new bootstrap.Toast("#error-response");
            $(".toast-body").empty("");
            $(".toast-body").append("Invalid file type");
            toast.show();

            $("#cover-image").val("");
        }
    });

    $("#events-form").on("submit", (event) => {
        event.preventDefault();
        $("#events-form").addClass("was-validated");

        let data = new FormData(event.target);
        var content = tinymce.get("content-body").getContent();

        data.append("body", content);
        data.append("action", "create");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/events/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                let toast = new bootstrap.Toast(document.getElementById("response"));
                $("#toast-body").html(response.success);
                $("#response").addClass("text-bg-success");
                toast.show();

                $("#events-form")[0].reset();
                $("#events-form").removeClass("was-validated");
            }
        }).fail(() => {
            console.log("error")
        })
    });

    $("#events-form-edit").on("submit", (event) => {
        event.preventDefault();
        event.preventDefault();
        $("#events-form-edit").addClass("was-validated");

        let data = new FormData(event.target);
        var content = tinymce.get("content-body").getContent();

        data.append("body", content);
        data.append("action", "edit");

        $.ajax({
            type: "POST",
            url: "/thesis/contents/events/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                let toast = new bootstrap.Toast(document.getElementById("response"));
                $("#toast-body").html(response.success);
                $("#response").addClass("text-bg-success");
                toast.show();

                $("#events-form-edit").removeClass("was-validated");
            },
        });
    });

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
        window.location = "/thesis/contents/events/all?page=1";
    });
    
</script>