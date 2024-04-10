<script>
    const date = new Date();
    const currentYear = date.getFullYear();
    let recipient = "";
    let isBatchInputValid = false;

    $("#email-recipient").on("change", (event) => {
        $("#per-track-recipient").prop("hidden", true);
        $("#per-batch-recipient").prop("hidden", true);

        recipient = event.target.value;

        if (event.target.value === "track") {
            $("#per-track-recipient").prop("hidden", false);
        }

        if (event.target.value === "batch") {
            $("#per-batch-recipient").prop("hidden", false);
        }
    });

    $("#per-batch-recipient").keyup(() => {
        if ($("#per-batch-recipient").val() < 2000 || Number($("#per-batch-recipient").val()) > currentYear) {
            $("#per-batch-recipient").addClass("border border-danger");
            $("#feedback-error").show();
            isBatchInputValid = false;
        } else {
            $("#per-batch-recipient").removeClass("border border-danger");
            $("#feedback-error").hide();
            isBatchInputValid = true;
        }
    });

    $("#send-email-form").on("submit", (event) => {
        event.preventDefault();

        const subject = $("#email-subject").val();
        const content = $("#content").val();
        const track = $('#per-track-recipient').find(":selected").val();

        if (subject === "" || content === "" || recipient === "") {
            $("#send-email-form").addClass("was-validated");
            return;
        }

        if (recipient === "track" && track === "") {
            $("#send-email-form").addClass("was-validated");
            return;
        }

        if (recipient === "batch" && !isBatchInputValid) {
            $("#send-email-form").addClass("was-validated");
            return;
        }

        const formData = new FormData(event.target);

        $("#loading").prop("hidden", false);
        $("#send-email-button").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "/thesis/email",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#alert").prop("hidden", false);

                if (response.sent) {
                    $("#alert").addClass("alert-success");
                    $("#send-email-form")[0].reset();
                } else {
                    $("#alert").addClass("alert-danger");
                }

                $("#loading").fadeOut();
                $("#alert").append(
                    `<div><i class="far fa-envelope"></i> ${response.response}</div>`
                );
                setTimeout(() => {
                    $("#alert").fadeOut();
                }, 3000);
            },
        });
    });
</script>