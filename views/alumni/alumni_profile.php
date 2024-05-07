<?php session_start() ?>

<?php

include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/models/Alumni.php";

?>

<?php
$alumni = new Alumni();

$alumniDetails = [];
if (isset($_GET["id"])) {
    $alumniDetails = $alumni->getAlumniById($_GET["id"]);
} else {
    $alumniDetails = $alumni->getAlumniByUserId($_SESSION["user_id"]);
}

$undergradDetails;


$alumniID = $alumniDetails["id"];
$schoolHistory = $alumni->getAlumniSchoolHistory($alumniID);
$presentStatus = $alumni->getPresentStatus($alumniID);
$curriculumExit = $alumni->getCurriculumExit($alumniID);

$statusBadgeClass = "";

if ($alumniDetails["status"] == "pending") {
    $statusBadgeClass = "badge rounded-pill bg-secondary";
} else {
    $statusBadgeClass = "badge rounded-pill bg-primary";
}

?>
<div class="main-body-padding w-75 mx-auto alumni-profile">
    <!-- Admin controls -->
    <div class="mb-3">
        <?php if ($_SESSION["type"] === "admin") { ?>
            <!--Navigation-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/home">Home</a></li>
                    <?php if ($alumniDetails["status"] === "pending") { ?>
                        <li class="breadcrumb-item"><a href="/thesis/admin/registration">Registration</a></li>
                    <?php } else { ?>
                        <li class="breadcrumb-item"><a href="/thesis/alumni/index?page=1">Records</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item" aria-current="page">Alumni</li>
                </ol>
            </nav>
            <!--Print-->
            <a href="/thesis/admin/alumni/print?id=<?php echo $alumniID ?>" class="btn btn-dark btn-sm">Print Details</a>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-4">

            <!--Photo-->
            <div class="mb-3 p-2 alumni-information text-center">
                <?php if (isset($alumniDetails["photo"])) { ?>
                    <img class="profile-photo" src="/thesis/public/images/alumni/<?php echo $alumniDetails["photo"] ?>" />
                <?php } else { ?>
                    <div class="photo-container mb-2 m-auto"></div>
                <?php } ?>
            </div>
            <!--Alumni status-->
            <div class="mb-3">
                <p>Alumni status <span class="<?php echo $statusBadgeClass; ?>"><?php echo $alumniDetails["status"] ?></span></p>
            </div>
            <!--Name-->
            <p class="mb-1">
                <i class="fas fa-user me-1"></i>
                <?php if (isset($alumniDetails["middleName"])) {
                    echo $alumniDetails["firstName"] . " " . $alumniDetails["middleName"] . " " . $alumniDetails["lastName"];
                } else {
                    echo $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
                } ?>
            </p>
            <!--Contact number-->
            <p class="mb-1"><i class="fas fa-phone me-1"></i><?php echo $alumniDetails["contactNumber"]; ?></p>
            <!--Email-->
            <p><i class="fas fa-envelope me-1"></i><?php echo $alumniDetails["email"]; ?></p>
        </div>
        <div class="col-8">
            <?php if ($_SESSION["type"] !== "admin") { ?>
                <a role="button" href="/thesis/alumni/edit?id=<?php echo $alumniDetails["id"] ?>" class="btn btn-outline-dark btn-sm mb-2"><i class="fas fa-pen"></i> Edit</a>
            <?php } ?>
            <!-- Gender, Age, Birthday -->
            <div class="d-flex">
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="gender">Gender</label>
                    <p class="mb-0" id="gender">
                        <?php echo $alumniDetails["gender"]; ?>
                    </p>
                </div>
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="gender">Age</label>
                    <p class="mb-0"><?php echo $alumniDetails["age"]; ?></p>
                </div>
                <div class="p-2 alumni-information flex-fill me-1">
                    <label class="label" for="gender">Birthday</label>
                    <p class="mb-0"><?php
                                    $birthday = strtotime($alumniDetails["birthday"]);
                                    echo date("M d, Y", $birthday);
                                    ?></p>
                </div>
            </div>
            <!-- Address -->
            <div class="p-2 alumni-information my-3">
                <label class="label" for="gender">Address</label>
                <p class="mb-0"><?php echo $alumniDetails["address"]; ?></p>
            </div>
            <!-- School History (Track finished, Strand finished, Year Graduated) -->
            <div class="d-flex align-items-center">
                <h5 class="m-0 me-1">History</h5>
                <button class="btn btn-sm btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#history" aria-expanded="false" aria-controls="collapseExample">
                    View
                </button>
            </div>
            <div class="collapse" id="history">
                <div class="d-flex">
                    <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                        <label class="label" for="gender">Track Finished</label>
                        <p class="mb-0"><?php echo $schoolHistory["track"]; ?></p>
                    </div>
                    <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                        <label class="label" for="gender">Strand Finished</label>
                        <p class="mb-0"><?php echo $schoolHistory["strand"]; ?></p>
                    </div>
                    <div class="p-2 alumni-information mt-2 flex-fill">
                        <label class="label" for="gender">Year Graduated</label>
                        <p class="mb-0"><?php echo $schoolHistory["yearGraduated"]; ?></p>
                    </div>
                </div>
                <!--Certifications-->
                <?php if (isset($schoolHistory["isCertified"]) && filter_var($schoolHistory["isCertified"], FILTER_VALIDATE_BOOLEAN)) { ?>
                    <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                        <label class="label" for="gender">Certification</label>
                        <p class="mb-0"><?php echo $schoolHistory["certifications"]; ?></p>
                    </div>
                <?php } ?>
                <!-- Present Status -->
                <div class="p-2 alumni-information me-1 mt-2">
                    <label class="label" for="gender">Present Status</label>
                    <p class="mb-0">
                        <?php echo $presentStatus["presentStatus"]; ?>
                    </p>

                    <?php if ($presentStatus["presentStatus"] === "Employed") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#present-status-employed" class="btn btn-sm btn-dark mt-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="present-status-employed">
                        <?php include "/xampp/htdocs/thesis/views/alumni/present_status/alumni_employed.php"; ?>
                    </div>

                    <?php if ($presentStatus["presentStatus"] === "University Student") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#present-status-university-student" class="btn btn-sm btn-dark mt-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="present-status-university-student">
                        <?php include "/xampp/htdocs/thesis/views/alumni/present_status/alumni_student.php" ?>
                    </div>
                </div>

                <div class="p-2 alumni-information me-1 mt-2">
                    <label class="label" for="gender">Curriculum Exit</label>
                    <p class="mb-0">
                        <?php echo $curriculumExit["pursuedCurriculumExit"]; ?>
                    </p>

                    <?php if ($curriculumExit["pursuedCurriculumExit"] === "Higher Education") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#higher_education" class="btn btn-sm btn-dark my-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="higher_education">
                        <?php include "/xampp/htdocs/thesis/views/alumni/curriculum_exit/higher_education.php"; ?>
                    </div>

                    <?php if ($curriculumExit["pursuedCurriculumExit"] === "Employment") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#employment" class="btn btn-sm btn-dark my-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="employment">
                        <?php include "/xampp/htdocs/thesis/views/alumni/curriculum_exit/employment.php"; ?>
                    </div>
                    <?php if ($curriculumExit["pursuedCurriculumExit"] === "Entrepreneurship") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#entrepreneurship" class="btn btn-sm btn-dark my-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="entrepreneurship">
                        <?php include "/xampp/htdocs/thesis/views/alumni/curriculum_exit/entrepreneur.php"; ?>
                    </div>
                    <?php if ($curriculumExit["pursuedCurriculumExit"] === "Middle-level skills development") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#mid-level" class="btn btn-sm btn-dark my-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="mid-level">
                        <?php include "/xampp/htdocs/thesis/views/alumni/curriculum_exit/mid_level.php"; ?>
                    </div>
                    <?php if ($curriculumExit["pursuedCurriculumExit"] === "None") { ?>
                        <button data-bs-toggle="collapse" data-bs-target="#none" class="btn btn-sm btn-dark my-2">Details</button>
                    <?php } ?>
                    <div class="collapse" id="none">
                        <?php include "/xampp/htdocs/thesis/views/alumni/curriculum_exit/none.php"; ?>
                    </div>
                </div>
            </div>
            <?php
            $additionalFieldAnswers = $alumni->getAdditionalFieldAnswers($alumniID);

            if ($additionalFieldAnswers->num_rows > 0) {
                $fields = $additionalFieldAnswers->fetch_all();
            ?>

                <div>
                    <div class="d-flex align-items-center my-3">
                        <h5 class="m-0 me-1">Additional information</h5>
                        <button class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#additional-fields">View</button>
                    </div>
                    <div class="collapse" id="additional-fields">
                        <?php foreach ($fields as $field) { ?>
                            <?php if ($field[4] == "user_defined") { ?>
                                <div class="p-2 alumni-information mt-2">
                                    <label class="label" for="gender"><?php echo $field[2]; ?></label>
                                    <p class="mb-0"><?php echo $field[1]; ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="p-2 alumni-information mt-2">
                                    <label class="label" for="gender"><?php echo $field[2];
                                                                        ?></label>
                                    <p class="mb-0"><?php echo $alumni->getChoiceName($field[1]);
                                                    ?></p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>