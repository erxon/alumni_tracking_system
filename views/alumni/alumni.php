<?php
require("/xampp/htdocs/thesis/models/Alumni.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = filter_input(INPUT_GET, "id");
    $alumni = new Alumni();

    $alumniDetails = $alumni->getAlumniById($id);
    $userProfile = $alumni->getAlumniUserProfile($alumniDetails["userAccountID"]);

    $statusBadgeClass = "";

    if ($alumniDetails["status"] == "pending") {
        $statusBadgeClass = "badge rounded-pill bg-secondary";
    } else {
        $statusBadgeClass = "badge rounded-pill bg-primary";
    }
}
?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>

<div class="main-body-padding w-75 mx-auto alumni-profile">

    <div class="d-flex align-items-center">
        <a href="<?php if ($alumniDetails["status"] == "pending") {
                        echo "/thesis/admin/registration";
                    } else if ($_SESSION["user_id"] == $alumniDetails["userAccountID"]) {
                        echo "/thesis/user/index";
                    } else {
                        echo "/thesis/alumni/index?page=1";
                    } ?>" role="button" class="btn btn-sm btn-outline-dark me-2"><i class="fas fa-arrow-left"></i> Back</a>
        <button id="print-alumni-data" class="btn btn-sm btn-dark"><i class="fas fa-print me-2"></i>Print</button>
    </div>
    <hr class="my-3" />
    <div id="alumni-details">
        <div hidden>
            <p>Heading for print</p>
        </div>
        <div class="row">
            <div class="col-4">
                <!--Photo-->
                <div class="mb-3 p-2 alumni-information text-center">
                    <?php if (isset($alumniDetails["photo"])) { ?>
                        <img id="alumni-profile-picture" src="/thesis/public/images/alumni/<?php echo ($alumniDetails["photo"]) ?>" class="profile-photo" />
                    <?php } else { ?>
                        <div class="photo-container mb-2 m-auto"></div>
                    <?php } ?>
                </div>
                <!--Name-->
                <div class="mb-3">
                    <p>Alumni status <span class="<?php echo $statusBadgeClass; ?>">
                            <?php echo $alumniDetails["status"] ?>
                        </span></p>
                </div>
                <p class="mb-1">
                    <i class="fas fa-user me-1"></i>
                    <?php if (isset($alumniDetails["middleName"])) {
                        echo $alumniDetails["firstName"] . " " . $alumniDetails["middleName"] . " " . $alumniDetails["lastName"];
                    } else {
                        echo $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
                    } ?>
                </p>
                <!--Contact number-->
                <p class="mb-1"><i class="fas fa-phone me-1"></i>
                    <?php echo $alumniDetails["contactNumber"]; ?>
                </p>
                <!--Email-->
                <p><i class="fas fa-envelope me-1"></i>
                    <?php echo $alumniDetails["email"]; ?>
                </p>
            </div>
            <div class="col-8">
                <?php if (($alumniDetails["userAccountID"] == $_SESSION["user_id"])) { ?>
                    <a role="button" href=<?php echo "/thesis/alumni/edit?id=" . $id; ?> class="btn btn-outline-dark btn-sm me-2"><i class="fas fa-pen"></i> Edit</a>
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
                        <p class="mb-0">
                            <?php echo $alumniDetails["age"]; ?>
                        </p>
                    </div>
                    <div class="p-2 alumni-information flex-fill me-1">
                        <label class="label" for="gender">Birthday</label>
                        <p class="mb-0">
                            <?php
                            $birthday = strtotime($alumniDetails["birthday"]);
                            echo date("M d, Y", $birthday);
                            ?>
                        </p>
                    </div>
                </div>
                <!-- Address -->
                <div class="p-2 alumni-information my-3">
                    <label class="label" for="gender">Address</label>
                    <p class="mb-0">
                        <?php echo $alumniDetails["address"]; ?>
                    </p>
                </div>
                <!-- School History (Track finished, Strand finished, Year Graduated) -->
                <p class="m-0 fw-bold">History</p>
                <div class="d-flex">
                    <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                        <label class="label" for="gender">Track Finished</label>
                        <p class="mb-0">
                            <?php echo $alumniDetails["trackFinished"]; ?>
                        </p>
                    </div>
                    <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                        <label class="label" for="gender">Strand Finished</label>
                        <p class="mb-0">
                            <?php echo $alumniDetails["strandFinished"]; ?>
                        </p>
                    </div>
                    <div class="p-2 alumni-information mt-2 flex-fill">
                        <label class="label" for="gender">Year Graduated</label>
                        <p class="mb-0">
                            <?php echo $alumniDetails["dateGraduated"]; ?>
                        </p>
                    </div>
                </div>
                <!-- Present Status -->
                <div class="p-2 alumni-information me-1 mt-2">
                    <label class="label" for="gender">Present Status</label>
                    <p class="mb-0">
                        <?php echo $alumniDetails["presentStatus"]; ?>
                    </p>
                    <?php if ($alumniDetails["presentStatus"] == "University Student") {
                        $undergraduateStudentDetails = $alumni->undergraduate($alumniDetails["undergraduate"]);
                    ?>
                        <hr />
                        <div>
                            <p class="m-0 fw-semibold alumni-info-header">Institution</p>
                            <p>
                                <?php echo $undergraduateStudentDetails["instName"]; ?>
                            </p>
                            <p class="m-0 fw-semibold alumni-info-header">Institution Address</p>
                            <p>
                                <?php echo $undergraduateStudentDetails["instAddress"]; ?>
                            </p>
                            <p class="m-0 fw-semibold alumni-info-header">Major</p>
                            <p>
                                <?php echo $undergraduateStudentDetails["specialization"]; ?>
                            </p>
                            <p class="m-0 fw-semibold alumni-info-header">Program</p>
                            <p>
                                <?php echo $undergraduateStudentDetails["program"]; ?>
                            </p>
                            <p class="m-0 fw-semibold alumni-info-header">Expected graduation date</p>
                            <p>
                                <?php echo $undergraduateStudentDetails["expGraduationDate"]; ?>
                            </p>
                        </div>
                    <?php } ?>
                </div>

                <!-- Curriculum Exit -->
                <div class="p-2 alumni-information me-1 mt-2">
                    <label class="label" for="gender">Curriculum Exit</label>
                    <p class="mb-0">
                        <?php echo $alumniDetails["curriculumExit"]; ?>
                    </p>
                    <?php $curriculumExitQuestions = $alumni->curriculumExitQuestions($alumniDetails["id"]); ?>
                    <?php if (count($curriculumExitQuestions) > 0) { ?>
                        <hr />
                        <div>
                            <?php foreach ($curriculumExitQuestions as $curriculumExitQuestion) {
                            ?>
                                <p class="fw-semibold m-0 alumni-info-header">
                                    <?php echo $curriculumExitQuestion[0] ?>
                                </p>
                                <p>
                                    <?php echo $curriculumExitQuestion[1] ?>
                                </p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $("#print-alumni-data").on("click", () => {
        print("alumni-details", "alumni-details");
    })
</script>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>