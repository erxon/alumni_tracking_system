<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<div class="registration-form">
    <form id="alumni-registration-form" class="container m-auto p-2" novalidate>
        <h1>Alumni Registration</h1>
        <p>Page <span id="pageNumber"></span> of 3</p>
        <div class="progress mb-4" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div id="progress" class="progress-bar"></div>
        </div>
        <div id="form-page-1" class="bg-white p-3 rounded">
            <h3 class="mb-3">Personal Information</h3>
            <div class="d-flex mb-3">
                <input id="first_name" type="text" class="form-control me-2" name="first_name" placeholder="First Name" required />
                <input id="middle_name" type="text" class="form-control me-2" name="middle_name" placeholder="Middle Name" />
                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Last Name" required />
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
                    <option value="Sports and Arts">Sports and Arts</option>
                </select>
                <select name="strand" id="strands-for-academic" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
                    <option selected value=""><b>Strand</b></option>
                    <option value="GA">General Academic</option>
                    <option value="HUMSS">Humanities and Social Sciences</option>
                    <option value="STEM">Science, Technology, Engineering, and Mathematics</option>
                    <option value="ABM">Accountancy, Business and Management</option>
                    <option value="Agri-Fishery Arts">Agri-Fishery Arts</option>
                    <option value="Home Economics">Home Economics</option>
                    <option value="Industrial Arts">Industrial Arts</option>
                    <option value="ICT">Information Communications Technology</option>
                    <option value="others">Others</option>
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
            <div class="mb-3">
                <label class="mb-1" for="curriculum-exits">Pursued curriculum exits after graduation</label>
                <select name="curriculum_exit" id="curriculum-exits" class="me-2 form-select form-select-md" aria-label="Small select example" required>
                    <option selected value="">Select</option>
                    <option value="Higher Education">Higher Education</option>
                    <option value="Employment">Employment</option>
                    <option value="Entrepreneurship">Entrepreneurship</option>
                    <option value="Middle-level skills development">Middle-level skills development</option>
                </select>
            </div>
            <div id="for-higher-education" class="curriculum-exits collapse">
                <div class="form-floating mb-1">
                    <input hidden name="question1" value="Which college or university did you enrolled?" />
                    <input id="inst-enrolled" class="form-control" type="text" name="answer1" placeholder="Which college or university did you enrolled?" />
                    <label for="inst-enrolled">Which college or university did you enrolled?</label>
                </div>
                <div class="form-floating mb-3">
                    <input hidden name="question2" value="What course or program are you currently pursuing?" />
                    <input id="program" class="form-control" type="text" name="answer2" placeholder="What course or program are you currently pursuing?" />
                    <label for="program">What course or program are you currently pursuing?</label>
                </div>
            </div>
            <div id="for-employment" class="curriculum-exits collapse">
                <div class="form-floating mb-3">
                    <input hidden name="question3" value="Which company or industry did you applied for?" />
                    <input id="company" class="form-control" type="text" name="answer3" placeholder="Which company or industry did you applied for?" />
                    <label for="company">Which company or industry did you applied for?</label>
                </div>
            </div>
            <div id="for-entrepreneurship" class="curriculum-exits collapse">
                <div class="form-floating mb-3">
                    <input hidden name="question4" value="Which business industry did you put up?" />
                    <input class="form-control" id="business" type="text" name="answer4" placeholder="Which business industry did you put up?" />
                    <label for="business">Which business industry did you put up?</label>
                </div>
                <div class="form-floating mb-3">
                    <input hidden name="question5" value="Which specialization did you engaged in?" />
                    <input id="business-specialization" class="form-control" type="text" name="answer5" placeholder="Which specialization did you engaged in?" />
                    <label for="business-specialization">Which specialization did you engaged in?</label>
                </div>
            </div>
            <!--Tracer study-->
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
        <div id="form-page-3" class="mb-3" style="display:none">
            <h3>Signup</h3>
            <div class="form-floating mb-3">
                <input id="username" class="form-control" type="text" name="username" placeholder="username" required />
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input id="password" class="form-control" type="password" name="password" placeholder="password" required />
                <label for="password">Password</label>
            </div>
        </div>
        <button id="alumni-form-previous-button" class="btn btn-outline-dark btn-sm" disabled><i class="fas fa-arrow-left"></i> Previous</button>
        <button id="alumni-form-next-button" type="submit" class="btn btn-outline-dark btn-sm"><span id="alumni-form-proceed-text">Next</span> <i class="fas fa-arrow-right"></i></button>
    </form>
</div>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>