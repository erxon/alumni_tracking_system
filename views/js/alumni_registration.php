<script>
    async function validateFirstPage(formData) {
        if (
            formData.first_name === "" ||
            formData.last_name === "" ||
            formData.contact_number === "" ||
            formData.email === "" ||
            formData.address === "" ||
            formData.birthdate === "" ||
            formData.age === "" ||
            formData.gender === "" ||
            formData.track === "" ||
            formData.strand === "" ||
            formData.year_graduated === "" ||
            formData.present_status === "") {
            throw new Error("Please fill all required fields");
            return;
        }
        if (formData.present_status === "University Student") {
            if (
                formData.inst_name === "" ||
                formData.inst_address === "" ||
                formData.specialization === "" ||
                formData.program === "" ||
                formData.exp_graduation_date === "") {
                throw new Error("Please fill all required fields");
                return;
            }
        }

        if (formData.present_status === "Did not continue to college" && formData.hs_grad_reason === "") {
            throw new Error("Please fill all required fields");
            return;
        }
    }

    async function validateSecondPage(formData) {
        if (formData.curriculum_exits === "") {
            throw new Error("Please specify your pursued curriculum exits after graduation");
            return;
        }
    }

    async function validateThirdPage(formData) {
        if (formData.username === "" || formData.password === "") {
            throw new Error("Please add your username and password");
            return;
        }
    }

    async function validation(formData, currentPage) {
        if (currentPage === 1) {
            try {
                await validateFirstPage(formData);
            } catch (error) {
                throw new Error(error.message);
            }
        } else if (currentPage === 2) {
            try {
                await validateSecondPage(formData);
            } catch (error) {
                throw new Error(error.message);
            }
        } else if (currentPage === 3) {
            try {
                await validateThirdPage(formData);
            } catch (error) {
                throw new Error(error.message);
            }
        }

    }

    const undergradForm = new bootstrap.Collapse(document.getElementById("undergradForm"), {
        toggle: false
    });

    const hsGradOnly = new bootstrap.Collapse(document.getElementById("hs-grad"), {
        toggle: false
    });

    document.getElementById("present_status").addEventListener("change", (event) => {
        event.target.value === "University Student" ? undergradForm.show() : undergradForm.hide();
        event.target.value === "Did not continue to college" ? hsGradOnly.show() : hsGradOnly.hide();
    });

    let page = 1;
    let progressWidth = (1 / 3) * 100;
    document.getElementById("pageNumber").innerHTML = page;
    document.getElementById("progress").style.width = `${progressWidth}%`;

    document.getElementById("alumni-registration-form").addEventListener("submit", async (event) => {
        event.preventDefault();

        try {
            const formData = new FormData();
            const data = processForm(event);
            // const validate = await validation(data, page);

            page += 1;

            if (page < 4) {
                progressWidth += (1 / 3) * 100;
                document.getElementById("progress").style.width = `${progressWidth}%`;
                document.getElementById("pageNumber").innerHTML = page;
                document.getElementById(`form-page-${page - 1}`).style.display = "none";
                document.getElementById(`form-page-${page}`).style.display = "block";
                document.getElementById("alumni-form-previous-button").disabled = false;
                document.getElementById("alumni-registration-form").classList.remove("was-validated");
            }

            if (page === 3) {
                document.getElementById("alumni-form-proceed-text").innerHTML = "Submit";
            }

            if (page === 4) {
                let params = new URLSearchParams(data).toString();
                console.log(data);
                alumniPost("/thesis/alumni/create", params);
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
        if (page !== 1) {
            page -= 1;
            progressWidth -= (1 / 3) * 100;
            document.getElementById("progress").style.width = `${progressWidth}%`;
            document.getElementById("pageNumber").innerHTML = page;

            document.getElementById(`form-page-${page+1}`).style.display = "none";
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
    });
</script>