<?php
$curriculumExitMidlevel = $alumni->getCurriculumExitMidLevelSkills($id);

$answer = $curriculumExitMidlevel["value"];
?>
<form id="curriculum-exit-mid-level-skills-development">
    <div class="mb-3">
        <label class="fw-semibold" style="font-size: 14px;" for="business-specialization">Which
            specialization did you engaged in?</label>
        <input value="<?php echo $answer; ?>" id="business-specialization" class="form-control" type="text" name="answer" placeholder="Type your answer" />
    </div>
    <button type="submit" class="btn btn-sm btn-dark">Save</button>
</form>