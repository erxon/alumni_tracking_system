<?php

include "/xampp/htdocs/thesis/models/AlumniEdit.php";

$alumniID = $_POST["alumniID"];
$toEdit = $_POST["toEdit"];
$alumniEdit = new AlumniEdit();


if ($toEdit == "present-status-university-student") {
    $result = $alumniEdit->updatePresentStatusStudent();
    echo json_encode(["response" => $result]);
}

if ($toEdit == "present-status-employed") {
    $result = $alumniEdit->updatePresentStatusEmployed();
    echo json_encode(["response" => $result]);
}

if ($toEdit == "curriculum-exit-employment") {
    $result = $alumniEdit->updateCurriculumExitEmployment();
    echo json_encode(["response" => $result]);
}

if ($toEdit == "curriculum-exit-university-student") {
    $result = $alumniEdit->updateCurriculumExitHigherEducation();
    echo json_encode(["response" => $result]);
}

if ($toEdit == "curriculum-exit-entrepreneurship") {
    $result = $alumniEdit->updateCurriculumExitEntrepreneurship();
    echo json_encode(["response" => $result]);
}

if($toEdit == "curriculum-exit-mid-level-skills-development") {
    $result = $alumniEdit->updateCurriculumExitMiddleLevelSkillsDevelopment();
    echo json_encode(["response" => $result]);
}

if($toEdit == "curriculum-exit-none") {
    $result = $alumniEdit->updateCurriculumExitNone();
    echo json_encode(["response" => $result]);
}

if($toEdit == "personal-information") {
    $result = $alumniEdit->updatePersonalInformation();
    echo json_encode(["response" => $result]);
}

if($toEdit == "personal-information-2") {
    $result = $alumniEdit->updatePersonalInformation2();
    echo json_encode(["response" => $result]);
}

if($toEdit == "alumni-school-history") {
    $result = $alumniEdit->updateAlumniSchoolHistory();
    echo json_encode(["response" => $result]);
}