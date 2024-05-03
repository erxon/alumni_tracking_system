<div class="">
    <div class="bg-white p-4 rounded mb-3">
        <div class="mb-3">
            <h5>Pursued curriculum exits after graduation</h5>
            <select name="curriculum-exit" id="curriculum-exits" class="me-2 form-select form-select-md" aria-label="Small select example" required>
                <option selected value="">Select</option>
                <option value="Higher Education">Higher Education</option>
                <option value="Employment">Employment</option>
                <option value="Entrepreneurship">Entrepreneurship</option>
                <option value="Middle-level skills development">Middle-level skills development
                </option>
                <option value="None">Did not choose any of the curriculum exit</option>
            </select>
        </div>
        <div id="for-higher-education" class="curriculum-exits collapse">
            <div class="form-floating mb-2">
                <select class="form-select" id="curriculum-exit-school-type" name="curriculum-exit-school-type" required>
                    <option selected value="">Select the type of school you are enrolled?</option>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
                <label for="curriculum-exit-school-type">Type of school you are enrolled</label>
            </div>
            <div class="form-floating">
                <select class="form-select" id="curriculum-exit-school-location" name="curriculum-exit-school-location" required>
                    <option selected value="">Select</option>
                    <option value="Cavite">Cavite</option>
                    <option value="Outside Cavite">Outside Cavite</option>
                </select>
                <label for="curriculum-exit-school-location">Are you enrolled in?</label>
            </div>
            <!--Institutions in Cavite-->
            <div class="collapse mt-2" id="curriculum-exit-cavite">
                <div class="form-floating">
                    <select id="curriculum-exit-inst-name" name="curriculum-exit-inst-name-cavite" class="form-select" required>
                        <option selected value="">Select a college or university</option>
                        <?php foreach ($institutionsInCavite as $institution) { ?>
                            <option value="<?php echo $institution ?>"><?php echo $institution ?></option>
                        <?php } ?>
                    </select>
                    <label for="curriculum-exit-inst-name">College or University</label>
                </div>
                <div class="d-flex mt-2 align-items-center">
                    <p class="m-0 me-2">Others: </p>
                    <input class="form-control" name="curriculum-exit-inst-name-cavite-other" placeholder="others" />
                </div>
            </div>
            <!--Institutions outside Cavite-->
            <div class="collapse mt-2" id="curriculum-exit-outside-cavite">
                <div class="form-floating">
                    <select id="curriculum-exit-inst-name" class="form-select" name="curriculum-exit-inst-name-outside-cavite" required>
                        <option selected value="">Select a college or university</option>
                        <?php foreach ($institutionsOutsideCavite as $institution) { ?>
                            <option value="<?php echo $institution ?>"><?php echo $institution ?></option>
                        <?php } ?>
                    </select>
                    <label for="curriculum-exit-inst-name-outside-cavite">College or University</label>
                </div>
                <div class="d-flex mt-2 align-items-center">
                    <p class="m-0 me-2">Others: </p>
                    <input class="form-control" name="curriculum-exit-inst-name-outside-cavite-other" placeholder="others" />
                </div>
            </div>

            <div class="mt-2" id="curriculum-exit-undergraduate-selection">
                <div class="d-flex">
                    <div class="form-floating flex-fill me-1">
                        <select name="curriculum-exit-undergraduate-selection-college" class="form-select" id="curriculum-exit-undergraduate-selection-college" required>
                            <option selected value="">Select a college</option>
                            <?php foreach ($colleges as $key => $value) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                        <label for="curriculum-exit-undergraduate-selection-college">Colleges</label>
                    </div>
                    <div class="form-floating flex-fill me-1">
                        <select name="curriculum-exit-undergraduate-selection-course" class="form-select" id="curriculum-exit-undergraduate-selection-course" required>
                            <option selected value="">Select a specific course</option>
                            <?php foreach ($collegeCourses as $college => $courses) { ?>
                                <?php foreach ($courses as $course) { ?>
                                    <option hidden class="<?php echo $college ?>" value="<?php echo $course ?>"><?php echo $course ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <label for="curriculum-exit-undergraduate-selection-course">Courses</label>
                    </div>
                    <input class="form-control" placeholder="Others" name="curriculum-exit-undergraduate-selection-course-other" required />
                </div>
            </div>
            <div class="form-floating mt-2">
                <input id="curriculum-exit-graduation-date" type="text" class="form-control" name="curriculum-exit-graduation-date" required />
                <label for="curriculum-exit-graduation-date">Year of Graduation</label>
            </div>
        </div>


        <div class="collapse mb-3 curriculum-exits" id="for-employment">
            <h5>Employed</h5>
            <div class="form-floating">
                <select class="form-select" id="curriculum-exit-work-location" name="curriculum-exit-work-location" required>
                    <option selected value="">Please select whether you&apos;re working Local or International</option>
                    <option value="local">Local</option>
                    <option value="international">International</option>
                </select>
                <label for="curriculum-exit-work-location">Are you working?</label>
            </div>
            <!--Internationa/Local Setting-->
            <div>
                <div class="collapse" id="curriculum-exit-work-local">
                    <div class="d-flex my-2">
                        <div class="form-floating flex-fill me-2">
                            <input id="curriculum-exit-work-local-region" name="curriculum-exit-work-local-region" class="form-control" placeholder="Region" />
                            <label for="curriculum-exit-work-local-region">Region</label>
                        </div>
                        <div class="form-floating flex-fill me-2">
                            <input id="curriculum-exit-work-local-municipality" name="curriculum-exit-work-local-municipality" class="form-control" placeholder="Municipality" />
                            <label for="curriculum-exit-work-local-municipality">Municipality</label>
                        </div>
                        <div class="form-floating flex-fill">
                            <input id="curriculum-exit-work-local-city" name="curriculum-exit-work-local-city" class="form-control" placeholder="City" />
                            <label for="curriculum-exit-work-local-city">City</label>
                        </div>
                    </div>
                    <div class="form-floating flex-fill">
                        <input id="curriculum-exit-work-local-curriculum-exit-work-local-details" name="curriculum-exit-work-local-details" class="form-control" placeholder="Details" />
                        <label for="details">Details</label>
                    </div>
                </div>
                <div class="collapse mt-3" id="curriculum-exit-work-international">
                    <div class="form-floating flex-fill me-2">
                        <select id="curriculum-exit-work-international-country" name="curriculum-exit-work-international-country" class="form-select">
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
                        <label for="curriculum-exit-work-international-country">Country</label>
                    </div>
                    <input id="curriculum-exit-work-international-country-other" placeholder="Other" name="curriculum-exit-work-international-country-other" class="form-control mt-2" />
                </div>

                <!--Job industry-->
                <div class="form-floating mt-2">
                    <select id="curriculum-exit-job-industry" name="curriculum-exit-job-industry" class="form-select job-industry" required>
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
                    <label for="curriculum-exit-job-industry">What job industry?</label>
                </div>
                <!--Organization type-->
                <div class="form-floating mt-2">
                    <select id="curriculum-exit-org-type" name="curriculum-exit-org-type" class="form-select" required>
                        <option selected value="">Select the type of organization you are working for</option>
                        <option value="private">Private</option>
                        <option value="public">Public</option>
                    </select>
                    <label for="curriculum-exit-org-type">Type of Organization you work for</label>
                </div>
                <!--Employment type-->
                <div class="form-floating mt-2">
                    <select id="curriculum-exit-employment-type" name="curriculum-exit-employment-type" class="form-select" required>
                        <option selected value="">Select your type of employment</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                        <option value="contractual">Contractual or Freelancing</option>
                        <option value="self-employed">Self-employed</option>
                    </select>
                    <label for="curriculum-exit-employment-type">Type of Employment</label>
                </div>
                <!--Job level-->
                <div class="form-floating mt-2">
                    <select id="curriculum-exit-job-level" name="curriculum-exit-job-level" class="form-select" required>
                        <option selected value="">Select your job level</option>
                        <option value="entry-level">Entry-level</option>
                        <option value="junior-level">Junior-level</option>
                        <option value="mid-level">Mid-level</option>
                        <option value="senior">Senior</option>
                        <option value="executive">Executive</option>
                    </select>
                    <label for="curriculum-exit-job-level">Job level</label>
                </div>
                <!--Company name-->
                <div class="form-floating mt-2">
                    <input id="curriculum-exit-company-name" class="form-control" name="curriculum-exit-company-name" placeholder="Company name" value="" />
                    <label for="curriculum-exit-company-name">Company name</label>
                </div>
                <!--Date hired-->
                <div class="form-floating mt-2">
                    <input id="curriculum-exit-date-hired" class="form-control date-hired" name="curriculum-exit-date-hired" placeholder="Date hired" value="" />
                    <label for="curriculum-exit-date-hired">Date hired</label>
                </div>
                <!--Salary Range-->
                <div class="form-floating mt-2">
                    <select id="curriculum-exit-salary-range" name="curriculum-exit-salary-range" class="form-select" required>
                        <option selected value="">Select your monthly salary range</option>
                        <option value="10000-15000">PHP 10,000 - PHP 15,000</option>
                        <option value="16000-25000">PHP 16,000 - PHP 25,000</option>
                        <option value="26000-50000">PHP 26,000 - PHP 50,000</option>
                        <option value="51000-100000">PHP 51,000 - PHP 100,000</option>
                    </select>
                    <label for="curriculum-exit-salary-range">Monthly salary range</label>
                </div>
                <!--Contact information of the company-->
                <div class="form-floating mt-2">
                    <input id="curriculum-exit-company-contact" class="form-control" name="curriculum-exit-company-contact" placeholder="Company" value="" required />
                    <label for="curriculum-exit-company-contact">Company contact information</label>
                </div>
                <!--Work setup-->
                <div class="form-floating mt-2">
                    <select name="curriculum-exit-work-setup" class="form-select" id="curriculum-exit-work-setup" required>
                        <option selected value="">Work setup</option>
                        <option value="on-site">On-site</option>
                        <option value="Work from home">Work from home</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                    <label for="curriculum-exit-work-setup">Work set-up</label>
                </div>
            </div>
        </div>
        <div id="for-entrepreneurship" class="curriculum-exits collapse">
            <div class="mb-3">
                <label class="fw-semibold" style="font-size: 14px;" for="business">Which business
                    industry did you put up?</label>
                <input value="" class="form-control" id="business" type="text" name="entrepreneurship" placeholder="Type your answer" required />
            </div>
        </div>
        <div id="for-middle-level-skills-development" class="curriculum-exits collapse">
            <div class="mb-3">
                <label class="fw-semibold" style="font-size: 14px;" for="business-specialization">Which
                    specialization did you engaged in?</label>
                <input value="" id="business-specialization" class="form-control" type="text" name="mid-level-skills" placeholder="Type your answer" required />
            </div>
        </div>
        <div id="for-did-not-continue-to-college" class="curriculum-exits collapse">
            <div class="form-floating" id="curriculum-exit-none">
                <select class="form-select" id="curriculum-exit-none-reason" name="curriculum-exit-none-reason" placeholder="Kindly state your reason" required>
                    <option selected value="">Choose one among the given reasons</option>
                    <option value="Personal problems">Personal problems</option>
                    <option value="Lack of awareness about the Curriculum Exits">Lack of awareness about the Curriculum Exits</option>
                    <option value="Unsure about future career plans">Unsure about future career plans</option>
                    <option value="Financial problems">Financial problems</option>
                </select>
                <label for="curriculum-exit-none-reason">Reasons</label>
            </div>
            <div class="d-flex mt-2">
                <p class="m-0 me-2">Other: </p>
                <input name="curriculum-exit-none-reason" class="form-control" placeholder="Other" required />
            </div>
        </div>
    </div>
</div>