<?php


$curriculumExitDetails = $alumni->getCurriculumExitEmployment($alumniDetails["id"]);

$workLocation = $curriculumExitDetails["workLocation"];
$region = $curriculumExitDetails["region"];
$municipality = $curriculumExitDetails["municipality"];
$city = $curriculumExitDetails["city"];
$details = $curriculumExitDetails["details"];
$country = $curriculumExitDetails["country"];
$jobIndustry = $curriculumExitDetails["jobIndustry"];
$orgType = $curriculumExitDetails["orgType"];
$employmentType = $curriculumExitDetails["employmentType"];
$jobLevel = $curriculumExitDetails["jobLevel"];
$companyName = $curriculumExitDetails["companyName"];
$companyContact = $curriculumExitDetails["companyContact"];
$dateHired = $curriculumExitDetails["dateHired"];
$workSetup = $curriculumExitDetails["workSetup"];
$salaryRange = $curriculumExitDetails["salaryRange"];

?>

<div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Work location</label>
        <p class="mb-0">
            <?php echo $workLocation; ?>
        </p>
    </div>
    <?php if ($workLocation === "local") { ?>
        <div class="d-flex mb-2">
            <div class="p-2 alumni-information me-1 flex-fill">
                <label class="label">Region</label>
                <p class="mb-0">
                    <?php echo $region; ?>
                </p>
            </div>
            <div class="p-2 alumni-information me-1 flex-fill">
                <label class="label">Municipality</label>
                <p class="mb-0">
                    <?php echo $municipality; ?>
                </p>
            </div>
            <div class="p-2 alumni-information me-1 flex-fill">
                <label class="label">City</label>
                <p class="mb-0">
                    <?php echo $city; ?>
                </p>
            </div>
        </div>
        <div class="p-2 alumni-information me-1 flex-fill">
            <label class="label">Details</label>
            <p class="mb-0">
                <?php echo $details; ?>
            </p>
        </div>
    <?php } ?>
    <?php if ($workLocation === "international") { ?>
        <div class="p-2 alumni-information mb-2">
            <label class="label">Country</label>
            <p class="mb-0">
                <?php echo ucfirst($country); ?>
            </p>
        </div>
    <?php } ?>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Job Industry</label>
        <p class="mb-0">
            <?php echo $jobIndustry; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Organization Type</label>
        <p class="mb-0">
            <?php echo $orgType; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Employment Type</label>
        <p class="mb-0">
            <?php echo $employmentType; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Job Level</label>
        <p class="mb-0">
            <?php echo $jobLevel; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Company Name</label>
        <p class="mb-0">
            <?php echo $companyName; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Company Contact</label>
        <p class="mb-0">
            <?php echo $companyContact; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Date Hired</label>
        <p class="mb-0">
            <?php echo $dateHired; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Work Setup</label>
        <p class="mb-0">
            <?php echo $workSetup; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mb-2">
        <label class="label">Salary Range</label>
        <p class="mb-0">
            <?php echo $salaryRange; ?>
        </p>
    </div>
</div>