<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="registration-form">
    <form id="alumni-registration-form" class="container m-auto p-2" novalidate>
        <h1>Alumni Registration</h1>
        <p>Page <span id="pageNumber"></span> of 3</p>
        <div class="progress mb-4" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div id="progress" class="progress-bar"></div>
        </div>
        <div id="form-page-1" class="bg-white p-3 rounded mb-3">
            <h3 class="mb-3">Personal Information</h3>
            <div class="d-flex flex-row mb-3">
                <div class="border border-1 rounded p-3 flex-fill me-2">
                    <p class="m-0 mb-1 text-secondary" style="font-size: 14px;">Digital photograph 2x2 (White background)</p>
                    <input type="file" name="alumni_photo" class="form-control" required />
                </div>
                <div class="flex-fill">
                    <input id="first_name" type="text" class="form-control mb-2" name="first_name" placeholder="First Name" required />
                    <input id="middle_name" type="text" class="form-control mb-2" name="middle_name" placeholder="Middle Name" />
                    <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Last Name" required />
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="input-group me-2">
                    <span class="input-group-text" id="basic-addon1">+63</span>
                    <input id="contact_number" type="text" class="form-control" name="contact_number" placeholder="Contact Number" required />
                </div>
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" required />
            </div>
            <input id="address" type="text" class="mb-3 form-control" name="address" placeholder="Complete Address" required />
            <div class="d-flex mb-3 align-items-center">
                <label class="me-1" for="birthdate">Birthdate</label>
                <input id="birthdate" type="date" name="birthdate" class="me-2 form-control" placeholder="Birthdate" required />
                <input id="age" type="number" name="age" class="me-2 form-control" placeholder="Age" required />
                <select id="gender" name="gender" class="form-select" aria-label="Small select example" required>
                    <option selected value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="d-flex mb-3">
                <select id="track" name="track" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                    <option selected value="">Track</option>
                    <option value="Academic">Academic</option>
                    <option value="TVL">Technical-Vocational-Livelihood</option>
                </select>

                <select disabled id="strand" name="strand" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                    <option selected id="strand-select-placeholder" value="">Select a strand</option>
                    <option style="display: none;" class="strands-for-academic" value="HUMSS">Humanities and Social Sciences</option>
                    <option style="display: none;" class="strands-for-academic" value="STEM">Science, Technology, Engineering, and Mathematics</option>
                    <option style="display: none;" class="strands-for-academic" value="ABM">Accountancy, Business and Management</option>
                    <option style="display: none;" class="strands-for-tvl" value="Home Economics">Home Economics</option>
                    <option style="display: none;" class="strands-for-tvl" value="Industrial Arts">Industrial Arts</option>
                    <option style="display: none;" class="strands-for-tvl" value="ICT">Information, Communication and Technology</option>
                </select>
                <input type="number" class="form-control" name="year_graduated" placeholder="Year graduated" required />
            </div>
            <div class="mb-3">
                <select id="present_status" name="present_status" class="me-2 form-select form-select-md" aria-label="Small select example" required>
                    <option selected value="">Present Status</option>
                    <option value="University Student">University Student</option>
                    <option value="Employed">Employed</option>
                    <option value="Unemployed">Unemployed</option>
                    <option value="Did not continue to college">Did not continue to college</option>
                </select>
            </div>
            <div class="collapse mb-3" id="undergradForm">
                <input type="text" class="mb-3 form-control" name="inst_name" placeholder="University/School Name" required />
                <input type="text" class="mb-3 form-control" name="inst_address" placeholder="University/School Address" required />
                <input type="text" class="mb-3 form-control" name="specialization" placeholder="Major/Specialization" required />
                <input type="text" class="mb-3 form-control" name="program" placeholder="Degree/Course" required />
                <label class="mb-1" for="expGraduationDate">Expected Graduation Date</label>
                <input id="expGraduationDate" type="text" class="form-control" name="exp_graduation_date" required />
            </div>
            <div class="collapse mb-3" id="hs-grad">
                <input type="text" class="mb-3 form-control" name="hs_grad_reason" placeholder="Kindly state your reason" required />
            </div>
            <input id="cert" type="text" class="mb-3 form-control" name="certifications" default placeholder="National Certification/s Acquired in High School" />
        </div>
        <div id="form-page-2" class="mb-3" style="display:none">
            <div class="mb-2">
                <h3>Tracer Study on the Kto12 Curriculum Exits of LYFJSHS
                    Graduates</h3>
                <p>Please answer the items applicable to you</p>

                <p>This study aims to track the status of the SHS graduates with respect to curriculum exits
                    such as higher education, (Kolehiyo) employment (trabaho), middle skills development
                    (Middle Skills Training), and entrepreneurship (negosyo). Moreover, the findings of the
                    study shall serve as an initial data for future research relative to SHS program
                    implementation to ensure evidenced-based decision-making in program adjustments,
                    interventions and initiatives.
                    Please take time to answer to questions provided in this form. We ensure that the data
                    gathered will be treated with utmost confidentiality and shall be used for the purpose of
                    the study</p>
            </div>
            <div class="row">
                <!--Tracer study-->
                <div class="col-8">
                    <div class="bg-white p-4 rounded mb-3">
                        <h5>Relevance of the Skills Acquired in SHS on the Curriculum
                            Exits </h5>
                        <p>
                            The items on the following section are the skills essential
                            for the curriculum exits. Please rate the relevance of each
                            skill using the 4 point likert scale below:
                        </p>
                        <ul>
                            <li>4 Strongly Agree</li>
                            <li>3 Agree</li>
                            <li>2 Fairly Agree</li>
                            <li>1 Disagree</li>
                        </ul>

                        <div class="container-fluid bg-white p-3 rounded">
                            <div class="d-flex">
                                <div style="width: 20%"></div>
                                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                                    <p class="mb-1">4</p>
                                    <p>Strongly Agree</p>
                                </div>
                                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                                    <p class="mb-1">3</p>
                                    <p>Agree</p>
                                </div>
                                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                                    <p class="mb-1">2</p>
                                    <p>Fairly Agree</p>
                                </div>
                                <div class="flex-fill text-center" style="width: 20%; font-size: 14px;">
                                    <p class="mb-1">1</p>
                                    <p>Disagree</p>
                                </div>
                            </div>
                            <?php
                            $sections = array(
                                "Information, media and technology skills",
                                "Learning and innovation skills",
                                "Effective communication skills",
                                "Life and career skills"
                            );

                            for ($i = 0; $i < count($sections); $i++) {
                                $inputName = "tracer_survey_answer_" . ($i + 1);
                            ?>
                                <div class="d-flex bg-body-secondary align-items-center rounded mb-2">
                                    <!--Question-->
                                    <div class="p-2" style="width: 20%; font-size: 14px;">
                                        <p><?php echo $sections[$i]; ?></p>
                                    </div>
                                    <!--Answers-->
                                    <div class="flex-fill text-center" style="width: 20%;">
                                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="4" required />
                                    </div>
                                    <div class="flex-fill text-center" style="width: 20%;">
                                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="3" required />
                                    </div>
                                    <div class="flex-fill text-center" style="width: 20%;">
                                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="2" required />
                                    </div>
                                    <div class="flex-fill text-center" style="width: 20%;">
                                        <input name="<?php echo $inputName; ?>" class="form-check-input" type="radio" value="1" required />
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="bg-white p-4 rounded mb-3">
                        <div class="mb-3">
                            <h5>Pursued curriculum exits after graduation</h5>
                            <select name="curriculum_exit" id="curriculum-exits" class="me-2 form-select form-select-md" aria-label="Small select example" required>
                                <option selected value="">Select</option>
                                <option value="Higher Education">Higher Education</option>
                                <option value="Employment">Employment</option>
                                <option value="Entrepreneurship">Entrepreneurship</option>
                                <option value="Middle-level skills development">Middle-level skills development</option>
                                <option value="Did not continue to college">Did not continue to college</option>
                            </select>
                        </div>
                        <div id="for-higher-education" class="curriculum-exits collapse">
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="inst-enrolled">Which college or university did you enrolled?</label>
                                <input hidden name="question1" value="Which college or university did you enrolled?" />
                                <input id="inst-enrolled" class="form-control" type="text" name="answer1" placeholder="Type your answer" />

                            </div>
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="program">What course or program are you currently pursuing?</label>
                                <input hidden name="question2" value="What course or program are you currently pursuing?" />
                                <input id="program" class="form-control" type="text" name="answer2" placeholder="Type your answer" />

                            </div>
                        </div>
                        <div id="for-employment" class="curriculum-exits collapse">
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="company">Which company or industry did you applied for?</label>
                                <input hidden name="question3" value="Which company or industry did you applied for?" />
                                <input id="company" class="form-control" type="text" name="answer3" placeholder="Type your answer" />
                            </div>
                        </div>
                        <div id="for-entrepreneurship" class="curriculum-exits collapse">
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="business">Which business industry did you put up?</label>
                                <input hidden name="question4" value="Which business industry did you put up?" />
                                <input class="form-control" id="business" type="text" name="answer4" placeholder="Type your answer" />
                            </div>
                        </div>
                        <div id="for-middle-level-skills-development" class="curriculum-exits collapse">
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="business-specialization">Which specialization did you engaged in?</label>
                                <input hidden name="question5" value="Which specialization did you engaged in?" />
                                <input id="business-specialization" class="form-control" type="text" name="answer5" placeholder="Type your answer" />
                            </div>
                        </div>
                        <div id="for-did-not-continue-to-college" class="curriculum-exits collapse">
                            <div class="mb-3">
                                <label class="fw-semibold" style="font-size: 14px;" for="reason">Please state your reason</label>
                                <input hidden name="question6" value="Please state your reason" />
                                <input id="reason" class="form-control" type="text" name="answer6" placeholder="Type your answer" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="form-page-3" class="mb-3" style="display:none">
            <div class="signup-form rounded p-3 bg-white">
                <h3>Signup</h3>
                <div class="form-floating mb-1">
                    <input id="username" class="form-control" type="text" name="username" placeholder="username" required />
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input id="password" class="form-control" type="password" name="password" placeholder="password" required />
                    <label for="password">Password</label>
                </div>
            </div>
        </div>
        <button id="alumni-form-previous-button" class="btn btn-outline-dark btn-sm" disabled><i class="fas fa-arrow-left"></i> Previous</button>
        <button id="alumni-form-next-button" type="submit" class="btn btn-outline-dark btn-sm"><span id="alumni-form-proceed-text">Next</span> <i class="fas fa-arrow-right"></i></button>
    </form>
    <div style="display: none;" id="success-message" class="alert alert-success w-75 container-fluid shadow p-3 rounded">
        <h2>You have successfully registered</h2>
        <p>Registration has been submitted and is subject for
            approval. A confirmation email will be sent to you
            once approved. Thank you.</p>
    </div>
</div>


<script>
    window.onload = () => {
        window.scrollTo(0, 0);
    }

    $("#track").on("change", (event) => {
        $("#strand").prop("disabled", false);

        if (event.target.value === "Academic") {
            $("#strand-select-placeholder").empty();
            $("#strand-select-placeholder").append("Select strand for Academic track");
            $(".strands-for-academic").show();
            $(".strands-for-tvl").hide();
        } else if (event.target.value === "TVL") {
            $("#strand-select-placeholder").empty();
            $("#strand-select-placeholder").append("Select strand for TVL track");
            $(".strands-for-tvl").show();
            $(".strands-for-academic").hide();
        }
    });

    async function validateFirstPage(formData) {
        if (
            formData.get("alumni_photo").name === "" ||
            formData.get("first_name") === "" ||
            formData.get("last_name") === "" ||
            formData.get("contact_number") === "" ||
            formData.get("email") === "" ||
            formData.get("address") === "" ||
            formData.get("birthdate") === "" ||
            formData.get("age") === "" ||
            formData.get("gender") === "" ||
            formData.get("track") === "" ||
            formData.get("strand") === "" ||
            formData.get("year_graduated") === "" ||
            formData.get("present_status") === "") {
            throw new Error("Please fill all required fields");
            return;
        }
        if (formData.get("present_status") === "University Student") {
            if (
                formData.get("inst_name") === "" ||
                formData.get("inst_address") === "" ||
                formData.get("specialization") === "" ||
                formData.get("program") === "" ||
                formData.get("exp_graduation_date") === "") {
                throw new Error("Please fill all required fields");
                return;
            }
        }

        if (formData.get("present_status") === "Did not continue to college" && formData.get("hs_grad_reason") === "") {
            throw new Error("Please fill all required fields");
            return;
        }
    }

    async function validateSecondPage(formData) {

        if (formData.get("curriculum_exit") === "" ||
            !formData.has("tracer_survey_answer_1") ||
            !formData.has("tracer_survey_answer_2") ||
            !formData.has("tracer_survey_answer_3") ||
            !formData.has("tracer_survey_answer_4")) {

            throw new Error("Please fill all required fields");

            return;
        }
    }

    async function validateThirdPage(formData) {
        if (formData.get("username") === "" || formData.get("password") === "") {
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

        window.scrollTo(0, 0);

        const formData = new FormData(event.target);
        console.log(formData)

        try {
            const validate = await validation(formData, page);

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
                //make this a jQuery
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
        event.target.value === "Middle-level skills development" ? collapseList[3].show() : collapseList[3].hide();
        event.target.value === "Did not continue to college" ? collapseList[4].show() : collapseList[4].hide();
    });
</script>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>