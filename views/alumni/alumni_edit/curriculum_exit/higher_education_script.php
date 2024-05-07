<script>
    const institutionsInCavite = new bootstrap.Collapse(document.getElementById("cavite"), {
        toggle: false
    });
    const institutionsOutsideCavite = new bootstrap.Collapse(document.getElementById("outside-cavite"), {
        toggle: false
    });

    window.onload = () => {
        const schoolLocation = "<?php echo $schoolLocation ?>";
        const college = "<?php echo $college; ?>";


        if (schoolLocation === "Cavite") {
            institutionsInCavite.show();
        } else if (schoolLocation === "Outside Cavite") {
            institutionsOutsideCavite.show();
        }

        $(`.${college}`).prop("hidden", false);
    }

    $("#graduation-date").datepicker({
        format: "yyyy",
        startView: 2,
        minViewMode: 2,
        maxViewMode: 2,
        startDate: "2024"
    });

    $("#school-location").on("change", (event) => {
        //reset
        $("#inst-name-cavite").prop("required", false);
        $("#inst-name-outside-cavite").prop("required", false);
        institutionsInCavite.hide();
        institutionsOutsideCavite.hide();

        //show the institution name field
        if (event.target.value === "Cavite") {
            $(".inst-name-cavite-class").prop("required", true);
            institutionsInCavite.show();
        } else if (event.target.value === "Outside Cavite") {
            $("#inst-name-outside-cavite").prop("required", true);
            institutionsOutsideCavite.show();
        }

    });

    $("#college").on("change", (event) => {
        $(".course-option").prop("hidden", true);
        $(`.${event.target.value}`).prop("hidden", false);
    });

    $("#curriculum-exit-university-student").on("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "curriculum-exit-university-student");

        formData.forEach((value, key) => {
            console.log(key, value);
        });

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
    });
</script>