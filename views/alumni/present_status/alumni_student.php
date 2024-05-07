<?php
include "data.php";

$presentStatusDetails = [];
if (isset($alumniDetails["id"])) {
    $presentStatusDetails = $alumni->getPresentStatusUniversityStudent($alumniDetails["id"]);
}

?>

<div class="mt-3">
    <div class="d-flex">
        <div class="p-2 alumni-information me-1 flex-fill">
            <label class="label">Type of School</label>
            <p class="mb-0">
                <?php echo $presentStatusDetails["schoolType"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information flex-fill">
            <label class="label">Location</label>
            <p class="mb-0">
                <?php echo $presentStatusDetails["schoolLocation"]; ?>
            </p>
        </div>
    </div>
    <div class="p-2 alumni-information mt-2">
        <label class="label">School name</label>
        <p class="mb-0">
            <?php echo $presentStatusDetails["schoolName"]; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mt-2">
        <label class="label">Program</label>
        <p class="mb-0">
            <?php echo $presentStatusDetails["program"]; ?>
        </p>
    </div>
    <?php if ($presentStatusDetails["program"] === "Undergraduate") { ?>
        <div class="d-flex mt-2">
            <div class="p-2 alumni-information me-1 flex-fill">
                <label class="label">College</label>
                <p style="font-size: 14px;" class="mb-0">
                    <?php echo $colleges[$presentStatusDetails["college"]]; ?>
                </p>
            </div>
            <div class="p-2 alumni-information flex-fill">
                <label class="label">Course</label>
                <p style="font-size: 14px;" class="mb-0">
                    <?php echo $presentStatusDetails["course"]; ?>
                </p>
            </div>
        </div>
    <?php } ?>
    <?php if ($presentStatusDetails["program"] === "Graduate") { ?>
        <div class="p-2 alumni-information mt-2">
            <label class="label">Graduate course</label>
            <p class="mb-0">
                <?php echo $presentStatusDetails["graduateCourse"]; ?>
            </p>
        </div>
    <?php } ?>
    <div class="p-2 alumni-information mt-2">
        <label class="label">Graduate date</label>
        <p class="mb-0">
            <?php echo $presentStatusDetails["graduateDate"]; ?>
        </p>
    </div>
</div>