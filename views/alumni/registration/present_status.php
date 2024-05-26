<div class="mb-3">
    <div class="form-floating">
        <select id="present-status" name="present-status" class="me-2 form-select form-select-md" aria-label="Small select example" required>
            <option selected value="">Kindly select your present status</option>
            <option value="University Student">University Student</option>
            <option value="Employed">Employed</option>
            <option value="Unemployed">Unemployed</option>
        </select>
        <label for="present-status">Are you currently?</label>
    </div>
</div>
<div class="collapse mb-3" id="forEmployedAlumni">
    <h5>Employed</h5>
    <div class="form-floating">
        <select class="form-select" name="work-location" id="work-location">
            <option selected value="">Please select whether you&apos;re working Local or International</option>
            <option value="local">Local</option>
            <option value="international">International</option>
        </select>
        <label for="work-location">Are you working? <span class="text-danger">*</span></label>
    </div>
    <!--Internationa/Local Setting-->
    <div>
        <div class="collapse" id="work-local">
            <div class="d-flex my-2">
                <div class="form-floating flex-fill me-2">
                    <input id="region" name="region" class="form-control" placeholder="Region" />
                    <label for="region">Region</label>
                </div>
                <div class="form-floating flex-fill me-2">
                    <input id="municipality" name="municipality" class="form-control" placeholder="Municipality" />
                    <label for="municipality">Municipality</label>
                </div>
                <div class="form-floating flex-fill">
                    <input id="city" name="city" class="form-control" placeholder="City" />
                    <label for="city">City</label>
                </div>
            </div>
            <div class="form-floating flex-fill">
                <input id="details" name="details" class="form-control" placeholder="Details" />
                <label for="details">Details</label>
            </div>
        </div>
        <div class="collapse mt-3" id="work-international">
            <div class="form-floating flex-fill me-2">
                <select id="country" class="form-select" name="country">
                    <option selected value="">Select country</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                    <option value="Japan">Japan</option>
                    <option value="Australia">Australia</option>
                    <option value="Italy">Italy</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Germany">Germany</option>
                    <option value="South Korea">South Korea</option>
                    <option value="Spain">Spain</option>
                    <option value="Other">Other</option>
                </select>
                <label for="country">Country </label>
            </div>
            <input class="form-control mt-1" placeholder="Other" name="country-other" />
        </div>

        <!--Job industry-->
        <div class="form-floating mt-2">
            <select id="job-industry" name="job-industry" class="form-select" required>
                <option selected value="">Select the job industry you are working in</option>
                <option value="Business Processing Outsourcing">Business Processing Outsourcing</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Manufacturing">Manufacturing</option>
                <option value="Retail">Retail</option>
                <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Real Estate">Real Estate</option>
                <option value="Education">Education</option>
                <option value="Agriculture and Agribusiness">Agriculture and Agribusiness</option>
                <option value="Energy">Energy</option>
                <option value="Telecommunications">Telecommunications</option>
                <option value="Government">Government</option>
            </select>
            <label for="job-industry">What job industry? <span class="text-danger">*</span></label>
        </div>
        <!--Organization type-->
        <div class="form-floating mt-2">
            <select id="org-type" name="org-type" class="form-select" required>
                <option selected value="">Select the type of organization you are working for</option>
                <option value="private">Private</option>
                <option value="public">Public</option>
            </select>
            <label for="org-type">Type of Organization you work for <span class="text-danger">*</span></label>
        </div>
        <!--Employment type-->
        <div class="form-floating mt-2">
            <select id="employment-type" name="employment-type" class="form-select" required>
                <option selected value="">Select your type of employment</option>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contractual">Contractual or Freelancing</option>
                <option value="self-employed">Self-employed</option>
            </select>
            <label for="employment-type">Type of Employment <span class="text-danger">*</span></label>
        </div>
        <!--Job level-->
        <div class="form-floating mt-2">
            <select id="job-level" name="job-level" class="form-select" required>
                <option selected value="">Select your job level</option>
                <option value="entry-level">Entry-level</option>
                <option value="junior-level">Junior-level</option>
                <option value="mid-level">Mid-level</option>
                <option value="senior">Senior</option>
                <option value="executive">Executive</option>
            </select>
            <label for="job-level">Job level <span class="text-danger">*</span></label>
        </div>
        <!--Company name-->
        <div class="form-floating mt-2">
            <input id="company-name" class="form-control" name="company-name" placeholder="Company name" value="" required/>
            <label for="company-name">Company name <span class="text-danger">*</span></label>
        </div>
        <!--Date hired-->
        <div class="form-floating mt-2">
            <input id="date-hired" class="form-control date-hired" name="date-hired" placeholder="Date hired" value="" />
            <label for="date-hired">Date hired <span class="text-danger">*</span></label>
        </div>
        <!--Salary Range-->
        <div class="form-floating mt-2">
            <select id="salary-range" name="salary-range" class="form-select">
                <option selected value="">Select your monthly salary range</option>
                <option value="10000-15000">PHP 10,000 - PHP 15,000</option>
                <option value="16000-25000">PHP 16,000 - PHP 25,000</option>
                <option value="26000-50000">PHP 26,000 - PHP 50,000</option>
                <option value="51000-100000">PHP 51,000 - PHP 100,000</option>
            </select>
            <label for="salary-range">Monthly salary range <span class="text-danger">*</span></label>
        </div>
        <!--Contact information of the company-->
        <div class="form-floating mt-2">
            <input id="company-contact" class="form-control" name="company-contact" placeholder="Company contact information" value="" />
            <label for="company-contact">Company contact information <span class="text-danger">*</span></label>
        </div>
        <!--Work setup-->
        <div class="form-floating mt-2">
            <select name="work-setup" class="form-select" id="work-setup">
                <option selected value="">Work setup</option>
                <option value="on-site">On-site</option>
                <option value="Work from home">Work from home</option>
                <option value="Hybrid">Hybrid</option>
            </select>
            <label for="work-setup">Work set-up <span class="text-danger">*</span></label>
        </div>
    </div>
</div>

<div class="collapse mb-3" id="undergradForm">
    <div class="form-floating mb-2">
        <select class="form-select" id="school-type" name="school-type" required>
            <option selected value="">Select the type of school you are enrolled?</option>
            <option value="private">Private</option>
            <option value="public">Public</option>
        </select>
        <label for="school-type">Type of school you are enrolled <span class="text-danger">*</span></label>
    </div>
    <div class="form-floating">
        <select class="form-select" id="school-location" name="school-location" required>
            <option selected value="">Select</option>
            <option value="Cavite">Cavite</option>
            <option value="Outside Cavite">Outside Cavite</option>
        </select>
        <label for="school-location">Are you enrolled in? <span class="text-danger">*</span></label>
    </div>
    <!--Institutions in Cavite-->
    <div class="collapse mt-2" id="cavite">
        <div class="form-floating">
            <select id="inst-name" name="inst-name-cavite" class="form-select" required>
                <option selected value="">Select a college or university</option>
                <?php foreach ($institutionsInCavite as $institution) { ?>
                    <option value="<?php echo $institution ?>"><?php echo $institution ?></option>
                <?php } ?>
            </select>
            <label for="inst-name">College or University <span class="text-danger">*</span></label>
        </div>
        <div class="d-flex mt-2 align-items-center">
            <p class="m-0 me-2">Others: </p>
            <input class="form-control" name="inst-name-cavite-other" placeholder="others" />
        </div>
    </div>
    <!--Institutions outside Cavite-->
    <div class="collapse mt-2" id="outside-cavite">
        <div class="form-floating">
            <select id="inst-name" class="form-select" name="inst-name-outside-cavite" required>
                <option selected value="">Select a college or university</option>
                <?php foreach ($institutionsOutsideCavite as $institution) { ?>
                    <option value="<?php echo $institution ?>"><?php echo $institution ?></option>
                <?php } ?>
            </select>
            <label for="inst-name">College or University <span class="text-danger">*</span></label>
        </div>
        <div class="d-flex mt-2 align-items-center">
            <p class="m-0 me-2">Others: </p>
            <input class="form-control" name="inst-name-outside-cavite-other" placeholder="others" />
        </div>
    </div>

    <!--Programs and Colleges-->
    <div class="form-floating mt-2">
        <select id="program" class="form-select" name="program" required>
            <option selected value="">Select enrolled program: </option>
            <option id="undergraduate-option" value="Undergraduate">Undergraduate</option>
            <option id="graduate-option" value="Graduate">Graduate</option>
        </select>
        <label for="program">Program enrolled <span class="text-danger">*</span></label>
    </div>
    <div class="collapse mt-2" id="undergraduate-selection">
        <div class="d-flex">
            <div class="form-floating flex-fill me-1">
                <select name="college" class="form-select" id="college">
                    <option selected value="">Select a college</option>
                    <?php foreach ($colleges as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                </select>
                <label for="college">Colleges <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating flex-fill me-1">
                <select name="course" class="form-select" id="course">
                    <option selected value="">Select a specific course</option>
                    <?php foreach ($collegeCourses as $college => $courses) { ?>
                        <?php foreach ($courses as $course) { ?>
                            <option hidden class="<?php echo $college ?>" value="<?php echo $course ?>"><?php echo $course ?>
                            </option>
                        <?php } ?>
                    <?php } ?>

                </select>
                <label for="course">Courses <span class="text-danger">*</span></label>
            </div>
            <input class="form-control" placeholder="Others" name="course-other" value="" />
        </div>
    </div>
    <div class="collapse mt-2" id="graduate-selection">
        <div class="form-floating flex-fill me-1">
            <select name="graduate-course" class="form-select" id="graduate-course">
                <option selected value="">Select a specific course</option>
                <?php foreach ($graduateCourses as $course) { ?>
                    <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                <?php } ?>
            </select>
            <label for="graduate-course">Courses <span class="text-danger">*</span></label>
        </div>
        <input class="form-control" placeholder="Others" name="graduate-course-other" value="" />
    </div>
    <div class="form-floating mt-2">
        <input id="graduation-date" type="text" class="form-control" name="graduation-date" required />
        <label for="graduation-date">Expected Graduation Date <span class="text-danger">*</span></label>
    </div>
</div>

