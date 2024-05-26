<script>
    let contentTitle = "";
    let contentId = "";
    let contentUrl = "";
    let host = "<?php echo $_SERVER["HTTP_HOST"]; ?>";
    let contentDescription = "";

    function alumniInfo(title, id, url, description) {
        contentTitle = title;
        contentId = id;
        contentUrl = `http://${host}${url}`;
        contentDescription = description;

        $("#content-title").empty();

        $("#content-title").append(
            `
            <div class="border p-2">
                <h5>${title}</h5>
                <p>${contentDescription}</p>
                <a href="${url}">${contentUrl}</a>
            </div>
            `
        );
    }



    const perTrackCollapse = new bootstrap.Collapse(document.getElementById("per-track"), {
        toggle: false
    });
    const perBatchCollapse = new bootstrap.Collapse(document.getElementById("per-batch"), {
        toggle: false
    });

    $("#target").on("change", (event) => {
        $("#per-track").val("");
        $("#per-batch").val("");
        $("#per-track").hide();
        $("#per-batch").hide();
        $(`#${event.target.value}`).show();
    });

    $("#send-email-button").on("click", (event) => {
        console.log(contentTitle)
        console.log(contentId);
        console.log($("#additional-note").val());

        let additionalNote = $("#additional-note").val();
        let formData = new FormData();
        let target = $("#target").val();
        let specificTarget = "";

        $("#send-email-form").addClass("was-validated");

        if ($("#target").val() === "per-track") {
            if ($("#per-track").val() === "") {
                return;
            }
            specificTarget = $("#per-track").val();
        }

        if ($("#target").val() === "per-batch") {
            if ($("#per-batch").val() === "") {
                return;
            }
            specificTarget = $("#per-batch").val();
        }

        formData.append("title", contentTitle);
        formData.append("id", contentId);
        formData.append("url", contentUrl);
        formData.append("description", contentDescription);
        formData.append("additional-note", additionalNote);
        formData.append("target", target);
        formData.append("specific-target", specificTarget);

        formData.forEach((value, key) => {
            console.log(value, key);
        })

        $("#loading").fadeIn();

        $.ajax({
            type: "POST",
            url: "/thesis/content/update",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.sent) {
                    const successToast = new bootstrap.Toast("#response");
                    $('#toast-body').empty();
                    $('#response').addClass("text-bg-success");
                    $("#toast-body").append(response.response);

                    successToast.show();
                } else {
                    const errorToast = new bootstrap.Toast("#error-response");
                    $('.toast-body').empty();
                    $(".toast-body").append(response.response);

                    errorToast.show();
                }
                $("#loading").fadeOut();
                $("#target").val("All");
                $("#per-track").prop("hidden", true);
                $("#per-track").val("");
                $("#per-batch").prop("hidden", true);
                $("#per-batch").val("");
                $("#additional-note").val("");
                $("#send-email-form").removeClass("was-validated");
            }
        })
    });
</script>