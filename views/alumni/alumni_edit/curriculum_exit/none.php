<?php

$curriculumExitDetails = $alumni->getCurriculumExitNone($id);

$answer = $curriculumExitDetails["value"];
?>
<form id="curriculum-exit-none">
    <div class="form-floating" id="curriculum-exit-none">
        <select class="form-select" id="curriculum-exit-none-reason" name="answer" placeholder="Kindly state your reason" required>
            <option selected value="">Choose one among the given reasons</option>
            <option <?php if ($answer == "Personal problems") {
                        echo "selected";
                    } ?> value="Personal problems">Personal problems</option>
            <option <?php if ($answer == "Lack of awareness about the Curriculum Exits") {
                        echo "selected";
                    } ?> value="Lack of awareness about the Curriculum Exits">Lack of awareness about the Curriculum Exits</option>
            <option <?php if ($answer == "Unsure about future career plans") {
                        echo "selected";
                    } ?> value="Unsure about future career plans">Unsure about future career plans</option>
            <option <?php if ($answer == "Financial problems") {
                        echo "selected";
                    } ?> value="Financial problems">Financial problems</option>
        </select>
        <label for="curriculum-exit-none-reason">Reasons</label>
    </div>
    <div class="d-flex mt-2">
        <p class="m-0 me-2">Other: </p>
        <input name="answer-other" class="form-control" placeholder="Other" />
    </div>
    <button type="submit" class="btn btn-sm btn-dark mt-2">Save</button>
</form>