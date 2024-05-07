<script>
    const workLocationLocal = new bootstrap.Collapse(document.getElementById("work-location-local"), {
        toggle: false
    });

    const workLocationInternational = new bootstrap.Collapse(document.getElementById("work-location-international"), {
        toggle: false
    });

    window.onload = () => {
        const workLocation = "<?php echo $workLocation ?>";

        if (workLocation === "local") {
            workLocationLocal.show();
        }
        if (workLocation === "international") {
            workLocationInternational.show();
        }
    }

    $("#date-hired").datepicker({
        format: "M yyyy",
        startView: 2,
    })

    $("#work-location").on("change", (event) => {
        console.log(event.target.value);

        workLocationLocal.hide();
        workLocationInternational.hide();

        if (event.target.value === "local") {
            workLocationLocal.show();
        } else if (event.target.value === "international") {
            workLocationInternational.show();
        }
    });

    $("#present-status-employed").on("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        formData.forEach((value, key) => {
            console.log(key, value);
        });

        formData.append("alumniID", <?php echo $id; ?>);
        formData.append("toEdit", "present-status-employed");

        $.ajax({
            type: "POST",
            url: "/thesis/alumni/edit/server",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const parsedResponse = JSON.parse(response);

                const successToast = new bootstrap.Toast("#response");
                const errorToast = new bootstrap.Toast("#error-response");

                if (parsedResponse.response) {
                    $("#toast-body").append("Sucessfully saved");
                    $("#response").addClass("text-bg-success");
                    successToast.show();
                } else {
                    $("#error-response #toast-body").append("Something went wrong");
                    errorToast.show();
                }
            }
        })
    })
</script>