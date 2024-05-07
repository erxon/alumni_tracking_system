<?php

$curriculumExitDetails = [];
if (isset($alumniDetails["id"])) {
    $curriculumExitDetails = $alumni->getCurriculumExitMidLevelSkills($alumniDetails["id"]);
}

$answer = $curriculumExitDetails["value"];

?>
<div class="mb-3">
    <label class="fw-semibold" style="font-size: 14px;" for="business-specialization">Which
        specialization did you engaged in?</label>
    <p class="m-0"><?php echo $answer; ?></p>
</div>