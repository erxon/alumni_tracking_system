<script>
    const institutionsInCavite = new bootstrap.Collapse(document.getElementById("cavite"), {
        toggle: false
    });
    const institutionsOutsideCavite = new bootstrap.Collapse(document.getElementById("outside-cavite"), {
        toggle: false
    });

    const undergraduateSelection = new bootstrap.Collapse(document.getElementById("undergraduate-selection"), {
        toggle: false
    });
    const graduateSelection = new bootstrap.Collapse(document.getElementById("graduate-selection"), {
        toggle: false
    });

    window.onload = () => {
        const schoolLocation = "<?php echo $schoolLocation ?>";
        const program = "<?php echo $program; ?>";
        const college = "<?php echo $college; ?>";


        if (schoolLocation === "Cavite") {
            institutionsInCavite.show();
        } else if (schoolLocation === "Outside Cavite") {
            institutionsOutsideCavite.show();
        }

        if (program === "Undergraduate") {
            undergraduateSelection.show()
        } else if (program === "Graduate") {
            graduateSelection.show();
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

    $("#program").on("change", (event) => {
        undergraduateSelection.hide();
        graduateSelection.hide();

        if (event.target.value === "Undergraduate") {
            undergraduateSelection.show();
        } else if (event.target.value === "Graduate") {
            graduateSelection.show();
        }
    })

    $("#college").on("change", (event) => {
        $(".course-option").prop("hidden", true);
        $(`.${event.target.value}`).prop("hidden", false);
    });

    $("#present-status-university-student").on("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        formData.append("alumniID", <?php echo $id ?>);
        formData.append("toEdit", "present-status-university-student");

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
                
                if(parsedResponse.response){
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