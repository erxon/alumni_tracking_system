<?php

include "/xampp/htdocs/thesis/views/alumni/registration/data.php";
$curriculumExitHigherEducation = $alumni->getCurriculumExitHigherEducation($id);

$schoolType = $curriculumExitHigherEducation["schoolType"];
$schoolLocation = $curriculumExitHigherEducation["schoolLocation"];
$schoolName = $curriculumExitHigherEducation["schoolName"];
$college = $curriculumExitHigherEducation["college"];
$course = $curriculumExitHigherEducation["course"];
$isOtherCourse = false;
$graduateDate = $curriculumExitHigherEducation["graduateDate"];

?>
<form id="curriculum-exit-university-student">
    <div class="form-floating mb-2">
        <select class="form-select" id="school-type" name="school-type">
            <option selected value="">Select the type of school you are enrolled?</option>
            <option <?php if ($schoolType === "private") {
                        echo "selected";
                    } ?> value="private">Private</option>
            <option <?php if ($schoolType === "public") {
                        echo "selected";
                    } ?> value="public">Public</option>
        </select>
        <label for="school-type">Type of school you are enrolled</label>
    </div>
    <div class="form-floating">
        <select class="form-select" id="school-location" name="school-location">
            <option selected value="">Select</option>
            <option <?php if ($schoolLocation === "Cavite") {
                        echo "selected";
                    } ?> value="Cavite">Cavite</option>
            <option <?php if ($schoolLocation === "Outside Cavite") {
                        echo "selected";
                    } ?> value="Outside Cavite">Outside Cavite</option>
        </select>
        <label for="school-location">Are you enrolled in?</label>
    </div>
    <!--Institutions in Cavite-->

    <div class="collapse mt-2" id="cavite">
        <div class="form-floating">
            <select id="inst-name-cavite" name="inst-name-cavite" class="form-select">
                <option selected value="">Select a college or university</option>
                <?php foreach ($institutionsInCavite as $institution) { ?>
                    <option <?php if ($schoolLocation === "Cavite" && $schoolName === $institution) {
                                echo "selected";
                            } ?> value="<?php echo $institution; ?>"><?php echo $institution; ?></option>
                <?php } ?>
            </select>
            <label for="inst-name-cavite">College or University</label>
        </div>
        <div class="d-flex mt-2 align-items-center">
            <p class="m-0 me-2">Others: </p>
            <input class="form-control" name="inst-name-cavite-other" placeholder="others" value="<?php
                                                                                                    if ($schoolLocation === "Cavite" && !in_array($schoolName, $institutionsInCavite)) {
                                                                                                        echo $schoolName;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }
                                                                                                    ?>" />
        </div>
    </div>


    <!--Institutions outside Cavite-->
    <div class="collapse mt-2" id="outside-cavite">
        <div class="form-floating">
            <select id="inst-name-outside-cavite" class="form-select" name="inst-name-outside-cavite">
                <option selected value="">Select a college or university</option>
                <?php foreach ($institutionsOutsideCavite as $institution) { ?>
                    <option <?php if ($schoolLocation === "Outside Cavite" && $institution === $schoolName) {
                                echo "selected";
                            } ?> value="<?php echo $institution ?>"><?php echo $institution ?></option>
                <?php } ?>
            </select>
            <label for="inst-name">College or University</label>
        </div>
        <div class="d-flex mt-2 align-items-center">
            <p class="m-0 me-2">Others: </p>
            <input class="form-control" name="inst-name-outside-cavite-other" placeholder="others" value="<?php
                                                                                                            if ($schoolLocation === "Outside Cavite" && (!in_array($schoolName, $institutionsOutsideCavite))) {
                                                                                                                echo $schoolName;
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            }
                                                                                                            ?>" />
        </div>
    </div>

    <!--Programs and Colleges-->

    <div class="d-flex my-2">
        <div class="form-floating flex-fill me-1">
            <select name="college" class="form-select" id="college">
                <option value="">Select a college</option>
                <?php foreach ($colleges as $key => $value) { ?>
                    <option <?php if ($key === $college) {
                                echo "selected";
                            } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            </select>
            <label for="college">Colleges</label>
        </div>
        <div class="form-floating flex-fill me-1">
            <select name="course" class="form-select" id="course">
                <option selected value="">Select a specific course</option>
                <?php foreach ($collegeCourses as $collegeGroup => $courses) { ?>
                    <?php foreach ($courses as $courseItem) { ?>
                        <option hidden <?php if ($courseItem == $course) {
                                            echo "selected";
                                        } ?> class="course-option <?php echo $collegeGroup; ?>" value="<?php echo $courseItem ?>"><?php echo $courseItem ?>
                        </option>
                    <?php } ?>
                <?php } ?>
            </select>
            <label for="course">Courses</label>
        </div>
        <input class="form-control" placeholder="Others" name="course-other" value="<?php if ($isOtherCourse) {
                                                                                        echo $course;
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>" />
    </div>
    <div class="collapse mt-2" id="graduate-selection">
        <div class="form-floating flex-fill me-1">
            <select name="graduate-course" class="form-select" id="graduate-course">
                <option selected value="">Select a specific course</option>
                <?php foreach ($graduateCourses as $graduateCourse) { ?>
                    <option <?php if ($graduateCourse == $course) {
                                echo "selected";
                            } ?> value="<?php echo $graduateCourse; ?>"><?php echo $graduateCourse; ?></option>
                <?php } ?>
            </select>
            <label for="graduate-course">Courses</label>
        </div>
        <input class="form-control mt-2" placeholder="Others" name="graduate-course-other" value="<?php if ($isOtherCourse) {
                                                                                                        echo $course;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>" />
    </div>

    <div class="form-floating mt-2">
        <input id="graduation-date" value="<?php echo $graduateDate; ?>" type="text" class="form-control" name="graduation-date" required />
        <label for="graduation-date">Expected Graduation Date</label>
    </div>

    <button class="btn btn-dark mt-3">Save</button>
</form>