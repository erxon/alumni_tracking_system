<?php

$presentStatusEmployed = [];

if (isset($alumniDetails["id"])) {
    $presentStatusEmployed = $alumni->getPresentStatusEmployed($alumniDetails["id"]);
}

function formatSalaryRange($salaryRange)
{
    $string = "26000-50000";
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

<div class="mt-2">
    <?php if ($presentStatusEmployed["workLocation"] === "international") { ?>
        <div class="d-flex">
            <div class="p-2 alumni-information me-1 flex-fill">
                <label class="label">Work Location</label>
                <p class="mb-0">
                    <?php echo ucfirst($presentStatusEmployed["workLocation"]); ?>
                </p>
            </div>
            <div class="p-2 alumni-information flex-fill">
                <label class="label">Country</label>
                <p class="mb-0">
                    <?php echo $presentStatusEmployed["country"]; ?>
                </p>
            </div>
        </div>
    <?php } ?>
    <?php if ($presentStatusEmployed["workLocation"] === "local") { ?>
        <div class="alumni-information p-2">
            <label class="label">Work Location</label>
            <p class="mb-0">
                <?php echo ucfirst($presentStatusEmployed["workLocation"]); ?>
            </p>
            <div class="d-flex">
                <div class="p-2 alumni-information me-1 flex-fill">
                    <label class="label">Region</label>
                    <p class="mb-0">
                        <?php echo ucfirst($presentStatusEmployed["region"]); ?>
                    </p>
                </div>
                <div class="p-2 alumni-information me-1 flex-fill">
                    <label class="label">Municipality</label>
                    <p class="mb-0">
                        <?php echo $presentStatusEmployed["municipality"]; ?>
                    </p>
                </div>
                <div class="p-2 alumni-information flex-fill">
                    <label class="label">City</label>
                    <p class="mb-0">
                        <?php echo $presentStatusEmployed["municipality"]; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="p-2 alumni-information mt-1">
            <label class="label">Details</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["details"]; ?>
            </p>
        </div>
    <?php } ?>
    <div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Job Industry</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["jobIndustry"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Organization Type</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["orgType"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Employment Type</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["employmentType"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Company Name</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["companyName"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Date Hired</label>
            <p class="mb-0">
                <?php echo $presentStatusEmployed["dateHired"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Work Setup</label>
            <p class="mb-0">
                <?php echo ucfirst($presentStatusEmployed["workSetup"]); ?>
            </p>
        </div>
        <div class="p-2 alumni-information mt-1">
            <label class="label">Salary Range</label>
            <p class="mb-0">
                <?php echo formatSalaryRange($presentStatusEmployed["salaryRange"]); ?>
            </p>
        </div>
    </div>
</div>