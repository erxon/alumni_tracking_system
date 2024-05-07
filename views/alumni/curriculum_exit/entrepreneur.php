<?php

$curriculumExitDetails = [];
if (isset($alumniDetails["id"])) {
    $curriculumExitDetails = $alumni->getCurriculumExitEntrepreneurship($alumniDetails["id"]);
}

$answer = $curriculumExitDetails["value"];
?>

<div class="mb-3">
    <label class="fw-semibold" style="font-size: 14px;" for="business">Which business
        industry did you put up?</label>
    <p class="m-0"><?php echo $answer ?></p>
</div>