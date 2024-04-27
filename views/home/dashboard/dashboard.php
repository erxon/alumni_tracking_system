<?php

include("/xampp/htdocs/thesis/models/Dashboard.php");
include("/xampp/htdocs/thesis/models/Reports.php");

$dashboard = new Dashboard();
$reports = new Reports();

$alumni = $dashboard->registeredAlumni();
$tracks = $dashboard->tracks();
$batchOrYear = $reports->numberOfAlumniPerYear();
$accordingToTrack = $reports->alumniAccordingToTrackPercentage();
$accordingToTrackNumeric = $reports->alumniAccordingToTrackNumeric();
$accordingToStrand = $reports->alumniAccordingToStrand();
$accordingToStrandNumeric = $reports->alumniAccordingToStrandNumeric();
$accordingToPresentStatus = $reports->alumniAccordingToPresentStatus();
$accordingToGender = $reports->alumniAccordingToGender();
$curriculumExit = $reports->curriculumExit();
$pendingAlumni = $reports->getPendingAlumni();
$skillsAcquired = $reports->getRelevantSkills();

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
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <div class="d-flex flex-column" style="height: 100px;">
                            <h5 class="h-100">Pending alumni registration</h5>
                            <p class="fs-6 text-primary"><i class="fas fa-user-graduate me-2"></i> <?php echo $pendingAlumni . " " . "alumni"; ?></p>
                        </div>
                        <a role="button" href="/thesis/admin/registration" class="btn btn-sm btn-primary">View</a>
                    </div>
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
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <h5>Male</h5>
                        <div class="d-flex flex-column justify-content-end" style="height: 50px;">
                            <p class="fs-6 text-primary"><i class="fas fa-male"></i>
                                <?php if (isset($accordingToGender[0]) && $accordingToGender[0]["label"] == "Male") {
                                    echo $accordingToGender[0]["y"];
                                } ?> alumni</p>
                        </div>
                    </div>
                    <div class="col shadow bg-white rounded p-3 me-2">
                        <h5>Female</h5>
                        <div class="d-flex flex-column justify-content-end" style="height: 50px;">
                            <p class="fs-6 text-primary"></i><i class="fas fa-female"></i>
                                <?php if (isset($accordingToGender[1]) && $accordingToGender[0]["label"] == "Female") {
                                    echo $accordingToGender[1]["y"];
                                } else {
                                    echo "0";
                                } ?> alumni</p>
                        </div>
                    </div>
                    <div class="col p-3 me-2"></div>
                    <div class="col p-3"></div>
                </div>
            </div>
            <hr class="m-3" />
            <?php include "charts.php" ?>
        </div>
    </div>
</div>