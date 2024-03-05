<?php session_start(); ?>


<?php include("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<div>
    <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    <div class="main-body-padding admin-views">
        <form id="send-email-form" class="needs-validation" novalidate>
            <div>
                <div>
                    <div class="mb-3">
                        <h5 class="modal-title"><i class="fas fa-envelope me-2"></i>Send email</h5>
                    </div>
                    <div class="modal-body">
                        <select name="recipient" id="email-recipient" class="form-select mb-1" aria-label="Default select example" required>
                            <option value="" selected>Recipient</option>
                            <option value="all">All</option>
                            <option value="track">Per track</option>
                            <option value="batch">Per batch</option>
                        </select>
                        <select hidden id="per-track-recipient" name="per-track-recipient" class="form-select mb-1" aria-label="Default select example" required>
                            <option value="" selected>Per track</option>
                            <option value="academic">Academic</option>
                            <option value="tvl">TVL</option>
                        </select>
                        <input hidden id="per-batch-recipient" name="per-batch-recipient" placeholder="Batch" type="Number" class="form-control mb-1" value="" required />
                        <div class="text-danger" style="display: none; font-size: 14px;" id="feedback-error">Invalid year</div>
                        <input id="email-subject" name="subject" class="form-control mb-1" placeholder="Subject" required />
                        <input id="email-title" name="title" class="form-control mb-1" placeholder="Title" required />
                        <textarea id="content" name="alumni_email_content" placeholder="Type your message here" class="form-control mb-3" required></textarea>
                        <div hidden id="loading" class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div hidden id="alert" class="alert" role="alert"></div>
                    </div>
                    <button id="send-email-button" type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
        const title = $("#email-title").val();
        const content = $("#content").val();
        const track = $('#per-track-recipient').find(":selected").val();

        if (subject === "" || title === "" || content === "" || recipient === "") {
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
<?php include("/xampp/htdocs/thesis/views/template/footer.php") ?>