<?php
include "/xampp/htdocs/thesis/views/alumni/registration/data.php";

$curriculumExitDetails = [];
if (isset($alumniDetails["id"])) {
    $curriculumExitDetails = $alumni->getCurriculumExitHigherEducation($alumniDetails["id"]);
}
?>

<div class="mt-3">
    <div class="d-flex">
        <div class="p-2 alumni-information me-1 flex-fill">
            <label class="label">Type of School</label>
            <p class="mb-0">
                <?php echo $curriculumExitDetails["schoolType"]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information flex-fill">
            <label class="label">Location</label>
            <p class="mb-0">
                <?php echo $curriculumExitDetails["schoolLocation"]; ?>
            </p>
        </div>
    </div>
    <div class="p-2 alumni-information mt-2">
        <label class="label">School name</label>
        <p class="mb-0">
            <?php echo $curriculumExitDetails["schoolName"]; ?>
        </p>
    </div>
    <div class="p-2 alumni-information mt-2">
        <label class="label">Program</label>
        <p class="mb-0">Undergraduate</p>
    </div>
    <div class="d-flex mt-2">
        <div class="p-2 alumni-information me-1 flex-fill">
            <label class="label">College</label>
            <p style="font-size: 14px;" class="mb-0">
                <?php echo $colleges[$curriculumExitDetails["college"]]; ?>
            </p>
        </div>
        <div class="p-2 alumni-information flex-fill">
            <label class="label">Course</label>
            <p style="font-size: 14px;" class="mb-0">
                <?php echo $curriculumExitDetails["course"]; ?>
            </p>
        </div>
    </div>
    <div class="p-2 alumni-information mt-2">
        <label class="label">Graduate date</label>
        <p class="mb-0">
            <?php echo $curriculumExitDetails["graduateDate"]; ?>
        </p>
    </div>
</div>