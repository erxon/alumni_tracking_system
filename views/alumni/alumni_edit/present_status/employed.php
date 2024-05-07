<?php

include "/xampp/htdocs/thesis/views/alumni/registration/data.php";

$presentStatusEmployed = $alumni->getPresentStatusEmployed($id);

$workLocation = $presentStatusEmployed["workLocation"];
$region = $presentStatusEmployed["region"];
$municipality = $presentStatusEmployed["municipality"];
$city = $presentStatusEmployed["city"];
$details = $presentStatusEmployed["details"];

$country = $presentStatusEmployed["country"];
$isOtherCountry = false;

if (!in_array($country, $countryOptions)) {
    $isOtherCountry = true;
}

$jobIndustry = $presentStatusEmployed["jobIndustry"];
$orgType = $presentStatusEmployed["orgType"];
$employmentType = $presentStatusEmployed["employmentType"];
$jobLevel = $presentStatusEmployed["jobLevel"];
$companyName = $presentStatusEmployed["companyName"];
$companyContact = $presentStatusEmployed["companyContact"];
$dateHired = $presentStatusEmployed["dateHired"];
$workSetup = $presentStatusEmployed["workSetup"];
$salaryRange = $presentStatusEmployed["salaryRange"];

function formatSalaryRange($salaryRange)
{
    $values = explode("-", $salaryRange);

    $finalResult = "";
    $increment = 0;

    foreach ($values as $value) {
        $result = "";

        $strPortion1 = substr($value, 0, strlen($value) - 3);
        $strPortion2 = substr($value, strlen($value) - 3, strlen($value) - 1);

        $result = "$strPortion1,$strPortion2";

        if ($increment == 0) {
            $finalResult .= "PHP $result-";
        } else {
            $finalResult .= " PHP $result";
        }

        $increment += 1;
    }

    return $finalResult;
}
?>

<form id="present-status-employed">
    <div class="mt-2">
        <div class="form-floating">
            <select class="form-select" name="work-location" id="work-location">
                <option <?php if ($workLocation === "local") {
                            echo "selected";
                        } ?> value="local">Local</option>
                <option <?php if ($workLocation === "international") {
                            echo "selected";
                        } ?> value="international">International</option>
            </select>
            <label for="work-location">Are you working?</label>
        </div>
        <div class="collapse my-2" id="work-location-local">
            <div class="d-flex mb-2">
                <div class="form-floating flex-fill me-2">
                    <input id="region" name="region" class="form-control" placeholder="Region" value="<?php echo $presentStatusEmployed["region"] ?>" />
                    <label for="region">Region</label>
                </div>
                <div class="form-floating flex-fill me-2">
                    <input id="municipality" name="municipality" class="form-control" placeholder="Municipality" value="<?php echo $presentStatusEmployed["municipality"] ?>" />
                    <label for="municipality">Municipality</label>
                </div>
                <div class="form-floating flex-fill">
                    <input id="city" name="city" class="form-control" placeholder="City" value="<?php echo $presentStatusEmployed["city"]; ?>" />
                    <label for="city">City</label>
                </div>
            </div>
            <div class="form-floating flex-fill">
                <input id="details" name="details" class="form-control" placeholder="Details" value="<?php echo $presentStatusEmployed["details"] ?>" />
                <label for="details">Details</label>
            </div>
        </div>
        <div class="collapse my-2" id="work-location-international">
            <div class="d-flex">
                <div class="p-2 alumni-information flex-fill">
                    <label class="label">Country</label>
                    <div class="form-floating flex-fill me-2">
                        <select id="country" class="form-select" name="country">
                            <option value="">Select a country</option>
                            <?php foreach ($countryOptions as $option) { ?>
                                <option <?php if ($option === $country) {
                                            echo "selected";
                                        } ?> value="<?php echo $option ?>">
                                    <?php echo $option ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="country">Country</label>
                    </div>
                    <input value="<?php if ($isOtherCountry) {
                                        echo $country;
                                    } else {
                                        echo "";
                                    } ?>" class="form-control mt-1" placeholder="Other" name="country-other" />

                </div>
            </div>
        </div>
        <div class="form-floating mt-2">
            <select id="job-industry" name="job-industry" class="form-select">
                <?php foreach ($jobIndustryOptions as $option) { ?>
                    <option <?php if ($option === $jobIndustry) {
                                echo "selected";
                            } ?> value="<?php echo $option; ?>"><?php echo $option ?></option>
                <?php } ?>
            </select>
            <label for="job-industry">What job industry?</label>
        </div>
        <div class="form-floating mt-2">
            <select id="org-type" name="org-type" class="form-select">
                <option selected value="">Select the type of organization you are working for</option>
                <option <?php if ($orgType === "private") {
                            echo "selected";
                        } ?> value="private">Private</option>
                <option <?php if ($orgType === "public") {
                            echo "selected";
                        } ?> value="public">Public</option>
            </select>
            <label for="org-type">Type of Organization you work for</label>
        </div>
        <div class="form-floating mt-2">
            <select id="employment-type" name="employment-type" class="form-select">
                <option selected value="">Select your type of employment</option>
                <option <?php if ($employmentType === "full-time") {
                            echo "selected";
                        } ?> value="full-time">Full-time</option>
                <option <?php if ($employmentType === "part-time") {
                            echo "selected";
                        } ?> value="part-time">Part-time</option>
                <option <?php if ($employmentType === "contractual") {
                            echo "selected";
                        } ?> value="contractual">Contractual or Freelancing</option>
                <option <?php if ($employmentType === "self-employed") {
                            echo "selected";
                        } ?> value="self-employed">Self-employed</option>
            </select>
            <label for="employment-type">Type of Employment</label>
        </div>
        <div class="form-floating mt-2">
            <select id="job-level" name="job-level" class="form-select">
                <option <?php if ($jobLevel === "entry-level") {
                            echo "selected";
                        } ?> value="entry-level">Entry-level</option>
                <option <?php if ($jobLevel === "junior-level") {
                            echo "selected";
                        } ?> value="junior-level">Junior-level</option>
                <option <?php if ($jobLevel === "mid-level") {
                            echo "selected";
                        } ?> value="mid-level">Mid-level</option>
                <option <?php if ($jobLevel === "senior") {
                            echo "selected";
                        } ?> value="senior">Senior</option>
                <option <?php if ($jobLevel === "executive") {
                            echo "selected";
                        } ?> value="executive">Executive</option>
            </select>
            <label for="job-level">Job level</label>
        </div>
        <div class="form-floating mt-2">
            <input id="company-name" class="form-control" name="company-name" placeholder="Company name" value="<?php echo $companyName  ?>" />
            <label for="company-name">Company name</label>
        </div>
        <!--Date hired-->
        <div class="form-floating mt-2">
            <input id="date-hired" class="form-control date-hired" name="date-hired" placeholder="Date hired" value="<?php echo $dateHired ?>" />
            <label for="date-hired">Date hired</label>
        </div>
        <!--Salary Range-->
        <div class="form-floating mt-2">
            <select id="salary-range" name="salary-range" class="form-select">
                <option selected value="">Select your monthly salary range</option>
                <option <?php if ($salaryRange === "10000-15000") {
                            echo "selected";
                        } ?> value="10000-15000">PHP 10,000 - PHP 15,000</option>
                <option <?php if ($salaryRange === "16000-25000") {
                            echo "selected";
                        } ?> value="16000-25000">PHP 16,000 - PHP 25,000</option>
                <option <?php if ($salaryRange === "26000-50000") {
                            echo "selected";
                        } ?> value="26000-50000">PHP 26,000 - PHP 50,000</option>
                <option <?php if ($salaryRange === "51000-100000") {
                            echo "selected";
                        } ?> value="51000-100000">PHP 51,000 - PHP 100,000</option>
            </select>
            <label for="salary-range">Monthly salary range</label>
        </div>
        <!--Contact information of the company-->
        <div class="form-floating mt-2">
            <input id="company-contact" class="form-control" name="company-contact" placeholder="Company contact information" value="<?php echo $companyContact ?>" />
            <label for="company-contact">Company contact information</label>
        </div>
        <!--Work setup-->
        <div class="form-floating mt-2">
            <select name="work-setup" class="form-select" id="work-setup">
                <option selected value="">Work setup</option>
                <option <?php if ($workSetup === "On-site") {
                            echo "selected";
                        } ?> value="On-site">On-site</option>
                <option <?php if ($workSetup === "Work from home") {
                            echo "selected";
                        } ?> value="Work from home">Work from home</option>
                <option <?php if ($workSetup === "Hybrid") {
                            echo "selected";
                        } ?> value="Hybrid">Hybrid</option>
            </select>
            <label for="work-setup">Work set-up</label>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-dark mt-2">Save</button>
</form>