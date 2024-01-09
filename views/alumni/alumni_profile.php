<?php session_start() ?>

<?php
include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Alumni.php");
?>

<?php
$alumni = new Alumni();

$undergradDetails;
$alumniDetails = $alumni->getAlumniByUserId($_SESSION["user_id"]);
$curriculumExitQuestions = $alumni->getCurriculumExitQuestions($alumniDetails["id"]);

if (isset($alumniDetails) && isset($alumniDetails["undergraduate"])) {
    $undergradDetails = $alumni->getUndergradDetails($alumniDetails["undergraduate"]);
}
?>

<div class="row main-body-padding w-75 m-auto alumni-profile">
    <div class="col-4">
        <!--Photo-->
        <div class="mb-3 p-2 alumni-information text-center">
            <?php if (isset($alumniDetails["photo"])) { ?>
                <img class="profile-photo" src="/thesis/public/images/profile/<?php echo $alumniDetails["photo"] ?>" />
            <?php } else { ?>
                <div class="photo-container mb-2 m-auto"></div>
            <?php } ?>
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
        <a role="button" href="/thesis/alumni/edit?id=<?php echo $alumniDetails["id"] ?>" class="btn btn-outline-dark btn-sm mb-2"><i class="fas fa-pen"></i> Edit</a>
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
            <p class="mb-0"><?php echo $alumniDetails["address"];  ?></p>
        </div>
        <!-- School History (Track finished, Strand finished, Year Graduated) -->
        <p>History</p>
        <div class="d-flex">
            <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                <label class="label" for="gender">Track Finished</label>
                <p class="mb-0"><?php echo $alumniDetails["trackFinished"];  ?></p>
            </div>
            <div class="p-2 alumni-information me-1 mt-2 flex-fill">
                <label class="label" for="gender">Strand Finished</label>
                <p class="mb-0"><?php echo $alumniDetails["strandFinished"];  ?></p>
            </div>
            <div class="p-2 alumni-information mt-2 flex-fill">
                <label class="label" for="gender">Year Graduated</label>
                <p class="mb-0"><?php echo $alumniDetails["dateGraduated"];  ?></p>
            </div>
        </div>
        <!-- Present Status -->
        <div class="p-2 alumni-information me-1 mt-2">
            <label class="label" for="gender">Present Status</label>
            <p class="mb-0"><?php echo $alumniDetails["presentStatus"];  ?></p>
        </div>
    </div>
</div>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>