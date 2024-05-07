<script>
    const date = new Date();
    const currentYear = date.getFullYear();
    let recipient = "";
    let isBatchInputValid = false;

    function addRecipient(email) {
        $("#individual-recipient").val(email);
        $("#search-result").empty();
        $("#search-result").hide();
    }

    $("#individual-recipient").on("keyup", (event) => {
        const value = event.target.value;

        $("#search-result").empty();
        $("#search-result").hide();

        if (value === "") {
            return;
        }

        $.ajax({
            type: "GET",
            url: `/thesis/email?recipient=${value}`,
            success: (response) => {
                const parseResponse = JSON.parse(response);
                console.log(parseResponse.result)
                if (parseResponse.result.length > 0) {
                    $("#search-result").show();
                    parseResponse.result.map((alumni) => {
                        $("#search-result").append(`
                        <div class='d-flex align-items-center'>
                        <img class='rounded-circle me-2' style='width: 56px; height: 56px; object-fit: cover;' 
                        src='/thesis/public/images/alumni/${alumni[1]}' />
                        <div>
                            <p class='m-0'>${alumni[3]} ${alumni[4]}</p>
                            <p class='m-0'>${alumni[2]}</p>
                            <button type="button" onclick="addRecipient('${alumni[2]}')" class="btn btn-sm btn-dark">Select</button>
                        </div>
                        </div>
                    `)
                    })
                }

            }
        })
    })

    $("#email-recipient").on("change", (event) => {
        $("#per-track-recipient").prop("hidden", true);
        $("#per-batch-recipient").prop("hidden", true);
        $("#individual-recipient-container").prop("hidden", true);

        recipient = event.target.value;

        if (event.target.value === "track") {
            $("#per-track-recipient").prop("hidden", false);
        }

        if (event.target.value === "batch") {
            $("#per-batch-recipient").prop("hidden", false);
        }

        if(event.target.value === "individual"){
            $("#individual-recipient-container").prop("hidden", false);
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