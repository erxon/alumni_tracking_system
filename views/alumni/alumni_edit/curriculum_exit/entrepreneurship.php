<?php
$curriculumExitEntrepreneurship = $alumni->getCurriculumExitEntrepreneurship($id);

$answer = $curriculumExitEntrepreneurship["value"];
?>


<form id="curriculum-exit-entrepreneurship">
    <div class="mb-3">
        <label class="fw-semibold" style="font-size: 14px;" for="business">Which business
            industry did you put up?</label>
        <input value="<?php echo $answer ?>" class="form-control" id="business" type="text" name="answer" placeholder="Type your answer" required />
    </div>
    <button type="submit" class="btn btn-dark btn-sm mt-2">Save</button>
</form>