<script>
    window.onload = () => {
        window.scrollTo(0, 0);

    }
    const date = new Date();
    const year = date.getFullYear() - 18;

    $("#birthdate").datepicker({
        format: "mm/dd/yyyy",
        startView: 2,
        maxViewMode: 2,
        endDate: `01/01/${year}`
    });

    $("#year-graduated").datepicker({
        format: "yyyy",
        startView: 2,
        maxViewMode: 2,
        minViewMode: 2,
        startDate: "2016",
        endDate: `${date.getFullYear()}`
    });

    $(".date-hired").datepicker({
        format: "M yyyy",
        startView: 2,
    })

    $("#birthdate").on("change", (event) => {
        const birthdate = new Date(event.target.value);
        const currentDate = new Date();
        let years = currentDate.getFullYear() - birthdate.getFullYear();

        if (birthdate.getMonth() > currentDate.getMonth() ||
            (birthdate.getDate() > currentDate.getDate() && birthdate.getMonth() > currentDate.getMonth())) {
            years = years - 1;
        }

        console.log(years);

        $("#age").val(years);

    })

    /**SCHOOL INFORMATION FORM**/
    //Track, Strand, & Specializations

    $("#track").on("change", (event) => {
        const data = <?php echo json_encode($strands); ?>;
        $("#strand").val("");
        $("#specialization").val("");
        $("#specialization").prop("disabled", true);

        $("#strand").val("");
        $("#strand-select-placeholder").empty();
        $("#strand-select-placeholder").append("Select a strand");
        $("#strand").prop("disabled", true);

        if (event.target.value) {
            $("#strand").prop("disabled", false);
            $("#strand-select-placeholder").append(` for ${event.target.value}`);
        }

        if (event.target.value === "Technical-Vocational and Livelihood") {
            $("#specialization").prop("disabled", false);
        }



        data.map((value) => {
            $(`.${value[3]}`).hide();
            if (event.target.value === value[0]) {
                $(`.${value[3]}`).show();
            }

        })

    });

    $("#strand").on("change", event => {
        const data = <?php echo json_encode($specializations); ?>;

        $("#specialization").val("");

        data.map((value) => {
            $(`.${value[4]}`).prop("hidden", true);
            if (value[2] === event.target.value) {
                $(`.${value[4]}`).prop("hidden", false);
            }
        })
    });

    //Certifications
    $(".is_certified").on("change", (event) => {

        if (event.target.value === "true") {
            $("#certification").prop("hidden", false);
        } else {
            $("#certification").prop("hidden", true);
        }
    })

    //Alumni Photo
    $("#alumni_photo").on("change", (event) => {
        const fileInput = document.getElementById("alumni_photo");

        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(event.target.value)) {
            $("#error").empty();
            $("#error").append("File not supported");
            $("#error").fadeIn();
            fileInput = "";
            return false;
        } else {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    document.getElementById(
                            'image-preview').innerHTML =
                        `<img style='object-fit: cover; width: 192px; height:192px;' src="` + e.target.result +
                        `"/>`;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    })

    const undergradForm = new bootstrap.Collapse(document.getElementById("undergradForm"), {
        toggle: false
    });

    const forEmployedAlumni = new bootstrap.Collapse(document.getElementById("forEmployedAlumni"), {
        toggle: false
    });

    document.getElementById("present-status").addEventListener("change", (event) => {
        event.target.value === "University Student" ? undergradForm.show() : undergradForm.hide();
        event.target.value == "Employed" ? forEmployedAlumni.show() : forEmployedAlumni.hide();
    });

    const formForWorkingLocal = new bootstrap.Collapse(document.getElementById("work-local"), {
        toggle: false
    });

    const curriculumExitFormForWorkingLocal = new bootstrap.Collapse(document.getElementById("curriculum-exit-work-local"), {
        toggle: false
    });

    const formForWorkingInternational = new bootstrap.Collapse(document.getElementById("work-international"), {
        toggle: false
    });

    const curriculumExitFormForWorkingInternational = new bootstrap.Collapse(document.getElementById("curriculum-exit-work-international"), {
        toggle: false
    });
    //Employed form
    $("#work-location").on("change", (event) => {
        console.log(event.target.value)

        formForWorkingLocal.hide();
        formForWorkingInternational.hide();

        if (event.target.value === "local") {
            formForWorkingLocal.show();
        }

        if (event.target.value == "international") {
            formForWorkingInternational.show();
        }
    });
    //Employed form - Curriculum Exit
    $("#curriculum-exit-work-location").on("change", (event) => {
        console.log(event.target.value)

        curriculumExitFormForWorkingLocal.hide();
        curriculumExitFormForWorkingInternational.hide();

        if (event.target.value === "local") {
            curriculumExitFormForWorkingLocal.show();
        }

        if (event.target.value == "international") {
            curriculumExitFormForWorkingInternational.show();
        }
    });
    //Undergraduate Form

    const institutionsInCavite = new bootstrap.Collapse(
        document.getElementById("cavite"), {
            toggle: false
        }
    );

    const curriculumExitInstitutionsInCavite = new bootstrap.Collapse(
        document.getElementById("curriculum-exit-cavite"), {
            toggle: false
        }
    );

    const institutionsOutsideCavite = new bootstrap.Collapse(
        document.getElementById("outside-cavite"), {
            toggle: false
        }
    );

    const curriculumExitInstitutionsOutsideCavite = new bootstrap.Collapse(
        document.getElementById("curriculum-exit-outside-cavite"), {
            toggle: false
        }
    );

    //School location
    $("#school-location").on("change", (event) => {
        console.log(event.target.value)

        institutionsInCavite.hide();
        institutionsOutsideCavite.hide();

        if (event.target.value === "Cavite") {
            institutionsInCavite.show();
        }
        if (event.target.value === "Outside Cavite") {
            institutionsOutsideCavite.show();
        }
    });

    //School location - Curriculum Exit
    $("#curriculum-exit-school-location").on("change", (event) => {
        console.log(event.target.value)

        curriculumExitInstitutionsInCavite.hide();
        curriculumExitInstitutionsOutsideCavite.hide();

        if (event.target.value === "Cavite") {
            curriculumExitInstitutionsInCavite.show();
        }
        if (event.target.value === "Outside Cavite") {
            curriculumExitInstitutionsOutsideCavite.show();
        }
    });

    const undergraduateSelection = new bootstrap.Collapse(document.getElementById("undergraduate-selection"), {
        toggle: false
    });

    const curriculumExitUndergraduateSelection = new bootstrap.Collapse(document.getElementById("curriculum-exit-undergraduate-selection"), {
        toggle: false
    });

    const graduateSelection = new bootstrap.Collapse(document.getElementById("graduate-selection"), {
        toggle: false
    });

    //Program
    $("#program").on("change", (event) => {
        undergraduateSelection.hide();
        graduateSelection.hide();

        if (event.target.value === "Undergraduate") {
            undergraduateSelection.show();
        }
        if (event.target.value === "Graduate") {
            graduateSelection.show();
        }
    });

    //College
    $("#college").on("change", (event) => {
        for (let i = 1; i < 10; i++) {
            $(`.COL${i}`).prop("hidden", true);
        }
        $("#course").val("");
        $(`.${event.target.value}`).prop("hidden", false);
    });

    //College - Curriculum Exit
    $("#curriculum-exit-undergraduate-selection-college").on("change", (event) => {
        for (let i = 1; i < 10; i++) {
            $(`.COL${i}`).prop("hidden", true);
        }
        $("#curriculum-exit-undergraduate-selection-course").val("");
        $(`.${event.target.value}`).prop("hidden", false);
    });

    //Graduation Date
    $("#graduation-date").datepicker({
        format: "yyyy",
        startView: 2,
        minViewMode: 2,
        maxViewMode: 2,
        startDate: "2024",
    });

    //Graduation Date - Curriculum Exit
    $("#curriculum-exit-graduation-date").datepicker({
        format: "yyyy",
        startView: 2,
        minViewMode: 2,
        maxViewMode: 2,
        startDate: "2020",
    })

    $(".datepicker").datepicker({});

    //Form Submission
    let page = 1;


    document.getElementById("alumni-registration-form").addEventListener("submit", async (event) => {
        event.preventDefault();

        window.scrollTo(0, 0);

        const formData = new FormData(event.target);


        try {
            const users = <?php echo json_encode($users); ?>;

            const findEmail = users.find((user) => {
                return user[0] === formData.get("email")
            })

            if (findEmail) {
                $("#email").addClass("border border-danger")
                $("#email-already-exists").show();
                return;
            }

            $("#email").removeClass("border border-danger")
            $("#email-already-exists").hide();

            const validate = await validation(formData, page);

            page += 1;

            if (page < 4) {
                document.getElementById(`form-page-${page - 1}`).style.display = "none";
                document.getElementById(`form-page-${page}`).style.display = "block";
                document.getElementById("alumni-form-previous-button").disabled = false;
                document.getElementById("alumni-registration-form").classList.remove("was-validated");
            }

            if (page === 3) {
                document.getElementById("alumni-form-proceed-text").innerHTML = "Finish";
            }

            if (page === 4) {
                $.ajax({
                    type: "POST",
                    url: "/thesis/alumni/create",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: (response) => {
                        const parsedResponse = JSON.parse(response);

                        if (parsedResponse.response === "success") {
                            $("#alumni-registration-form").empty();

                            $(`#form-page-3`).hide();

                            $("#success-message").fadeIn();

                        } else {
                            const toast = new bootstrap.Toast("#response");

                            $("#toast-body").append("Something went wrong");

                            toast.show();
                        }
                    }
                });
            }

        } catch (error) {
            document.getElementById("alumni-registration-form").classList.add("was-validated");
            const toast = new bootstrap.Toast(document.getElementById("response"));
            document.getElementById("toast-body").innerHTML = error;
            toast.show();
        }

    });

    document.getElementById("alumni-form-previous-button").addEventListener("click", (event) => {
        event.preventDefault();

        window.scrollTo(0, 0);

        if (page !== 1) {
            page -= 1;

            document.getElementById(`form-page-${page + 1}`).style.display = "none";
            document.getElementById(`form-page-${page}`).style.display = "block";

            document.getElementById("alumni-form-proceed-text").innerText = "Next";
        }
        if (page === 1) {
            document.getElementById("alumni-form-previous-button").disabled = true;
        }
    });

    const collapseElementList = document.querySelectorAll('.curriculum-exits')
    const collapseList = [...collapseElementList].map(collapseEl => new bootstrap.Collapse(collapseEl, {
        toggle: false
    }));

    document.getElementById("curriculum-exits").addEventListener("change", (event) => {
        event.target.value === "Higher Education" ? collapseList[0].show() : collapseList[0].hide();
        event.target.value === "Employment" ? collapseList[1].show() : collapseList[1].hide();
        event.target.value === "Entrepreneurship" ? collapseList[2].show() : collapseList[2].hide();
        event.target.value === "Middle-level skills development" ? collapseList[3].show() : collapseList[3].hide();
        event.target.value === "None" ? collapseList[4].show() : collapseList[4].hide();
    });
</script>