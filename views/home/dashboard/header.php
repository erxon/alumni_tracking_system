<?php
include("/xampp/htdocs/thesis/models/Dashboard.php");
include("/xampp/htdocs/thesis/models/Reports.php");

$dashboard = new Dashboard();
$reports = new Reports();

$batch = "";
$track = "";
$strand = "";

if (isset($_GET["batch"])) {
    $batch = $_GET["batch"];
}
if (isset($_GET["track"])) {
    $track = $_GET["track"];
}
if (isset($_GET["strand"])) {
    $strand = $_GET["strand"];
}

$alumni = $dashboard->registeredAlumni();
$tracks = $dashboard->tracks();
$batchOrYear = $reports->numberOfAlumniPerYear();
$accordingToTrack = $reports->alumniAccordingToTrackPercentage();
$accordingToTrackNumeric = $reports->alumniAccordingToTrackNumeric();
$accordingToStrand = $reports->alumniAccordingToStrand();
$accordingToStrandNumeric = $reports->alumniAccordingToStrandNumeric();

$accordingToGender = $reports->alumniAccordingToGender();

$pendingAlumni = $reports->getPendingAlumni();
$skillsAcquired = $reports->getRelevantSkills();

$batches = $reports->getBatches();
$tracksOption = $reports->getTracks();
$strandsOption = $reports->getStrands();


$graduatesPerStrand = $reports->graduatesPerStrand($batch, $track, $strand);
$accordingToPresentStatus = $reports->alumniAccordingToPresentStatus($batch, $track, $strand);
$curriculumExit = $reports->curriculumExit($batch, $track, $strand);
$gender = $reports->gender($batch, $track, $strand);

$yearGraduatedTrend = $reports->yearGraduatedTrend();

if (str_contains($_SERVER["REQUEST_URI"],"/thesis/admin/alumnitrends")) {
    $yearGraduatedTrendTracks = $reports->yearGraduatedTrendTracks($trackTrend, $strandTrend);
    $yearGraduatedPresentStatusAll = $reports->yearGraduatedPresentStatusAll();
    $yearGraduatedPresentStatus = $reports->yearGraduatedPresentStatus($presentStatus);
    $yearGraduatedCurriculumExitAll = $reports->yearGraduatedCurriculumExitAll();
    $yearGraduatedCurriculumExits = $reports->yearGraduatedCurriculumExits($alumniTrendCurriculumExit);
}
?>
<!--Dashboard-->
<div class="d-flex">
    <div>
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    </div>
    <div class="admin-views">
        <div>
            <div class="mb-2 pt-5 pb-3 px-5">
                <h1>Dashboard</h1>
            </div>
            <div class="py-3 px-5">
                <div class="row g-2 me-0">
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <div class="d-flex flex-column" style="height: 100px;">
                            <h5 class="h-100">Total Registered Alumni</h5>
                            <p class="fs-6 text-primary"><i class="fas fa-user-graduate me-2"></i> <?php echo $alumni . " " . "alumni"; ?></p>
                        </div>
                    </div>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <div class="col shadow bg-white rounded p-3 me-2">
                            <div class="d-flex flex-column" style="height: 100px;">
                                <h5 class="h-100">Pending alumni registration</h5>
                                <p class="fs-6 text-primary"><i class="fas fa-user-graduate me-2"></i> <?php echo $pendingAlumni . " " . "alumni"; ?></p>
                            </div>

                            <a role="button" href="/thesis/admin/registration" class="btn btn-sm btn-primary">View</a>

                        </div>
                    <?php } ?>

                    <div class="col shadow bg-white rounded p-3 me-2">

                        <div class="d-flex flex-column" style="height: 100px;">
                            <h5 class="h-100">Academic track</h5>
                            <p class="fs-6 text-primary"><i class="fas fa-book"></i> <?php echo $tracks["Academic"] ?> alumni</p>
                        </div>
                    </div>
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <div class="d-flex flex-column" style="height: 100px;">
                            <h5 class="h-100">TVL track</h5>
                            <p class="fs-6 text-primary"></i><i class="fas fa-tools"></i> <?php echo $tracks["TVL"] ?> alumni</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 g-2 me-0">
                    <?php foreach ($accordingToGender as $genderRow) { ?>
                        <div class="col shadow bg-white rounded p-3 me-2">
                            <h5><?php echo $genderRow["label"] ?></h5>
                            <div class="d-flex flex-column justify-content-end" style="height: 50px;">
                                <p class="text-primary"><?php echo $genderRow["y"] ?> alumni</p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col p-3 me-2"></div>
                    <div class="col p-3"></div>
                </div>
            </div>
            <hr class="m-3" />