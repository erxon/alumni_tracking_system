<?php session_start(); ?>

<?php

include("/xampp/htdocs/thesis/models/Reports.php");
include("/xampp/htdocs/thesis/models/Database.php");

$reports = new Reports();

$numberOfAlumniPerYear = $reports->numberOfAlumniPerYear();
$alumniAccordingToTrack = $reports->alumniAccordingToTrackPercentage();
$alumniAccordingToTrackNumeric = $reports->alumniAccordingToTrackNumeric();
$alumniAccordingToStrand = $reports->alumniAccordingToStrand();
$alumniAccordingToStrandNumeric = $reports->alumniAccordingToStrandNumeric();
$alumniAccordingToPresentStatus = $reports->alumniAccordingToPresentStatus();
$alumniAccordingToGender = $reports->alumniAccordingToGender();

?>

<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>
<div>
    <div class="mb-2">
        <div class="d-flex flex-row align-items-center mb-2">
            <p class="m-0">Batch/Year Graduated</p>
            <button data-bs-toggle="collapse" data-bs-target="#graph-1" id="collapse-1" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
        </div>
        <div class="collapse" id="graph-1">
            <div class="row">
                <div class="col-8">
                    <div id="graphContainer1" style="height: 370px; width: 100%"></div>
                </div>
                <div class="col-4">
                    <table class="table">
                        <thead>
                            <th>Batch</th>
                            <th class="text-end"><i class="fas fa-user-graduate me-1"></i> Graduates</th>
                        </thead>
                        <?php foreach ($numberOfAlumniPerYear as $batch) { ?>

                            <tr>
                                <td>
                                    <?php echo $batch["label"]; ?>
                                </td>
                                <td class="text-end">
                                    <?php echo $batch["y"]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="mb-2">
        <div class="d-flex flex-row align-items-center mb-2">
            <p class="m-0">Track and Strand (Pie graph)</p>
            <button data-bs-toggle="collapse" data-bs-target="#graph-2" id="collapse-2" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
        </div>
        <div class="collapse" id="graph-2">
            <div class="row mb-3">
                <div class="col-8">
                    <div id="graphContainer2" style="height: 370px"></div>
                </div>
                <div class="col-4">
                    <table class="table">
                        <thead>
                            <th></th>
                            <th class="text-end">Academic</th>
                            <th class="text-end">TVL</th>
                        </thead>
                        <tr>
                            <th scope="row">Alumni</th>
                            <td class="text-end">
                                <?php if (isset($alumniAccordingToTrackNumeric["Academic"])) { 
                                     echo $alumniAccordingToTrackNumeric["Academic"];
                                } else {
                                    echo "0";
                                } ?>
                                
                            </td>
                            <td class="text-end">
                            <?php if (isset($alumniAccordingToTrackNumeric["TVL"])) { 
                                     echo $alumniAccordingToTrackNumeric["TVL"];
                                } else {
                                    echo "0";
                                } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div id="tvlTrackGraph" style="height: 300px;"></div>
                    <table class="table mt-2">
                        <thead>
                            <th>Strand</th>
                            <th class="text-end">Alumni</th>
                        </thead>
                        <?php foreach ($alumniAccordingToStrandNumeric["TVL"] as $strand) { ?>
                            <tr>
                                <td>
                                    <?php echo $strand["label"] ?>
                                </td>
                                <td class="text-end">
                                    <?php echo $strand["y"]; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>
                <div class="col-lg-6">
                    <div id="academicTrackGraph" style="height: 300px;"></div>
                    <table class="table mt-2">
                        <thead>
                            <th>Strand</th>
                            <th class="text-end">Alumni</th>
                        </thead>

                        <?php foreach ($alumniAccordingToStrandNumeric["Academic"] as $strand) { ?>
                            <tr>
                                <td>
                                    <?php echo $strand["label"] ?>
                                </td>
                                <td class="text-end">
                                    <?php echo $strand["y"]; ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="d-flex flex-row align-items-center mb-2">
            <p class="m-0">Present status</p>
            <button data-bs-toggle="collapse" data-bs-target="#graph-3" id="collapse-3" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
        </div>
        <div class="collapse" id="graph-3">
            <div id="graphContainer3" style="height: 370px"></div>
            <table class="table mt-3">
                <thead class="text-end">
                    <?php foreach ($alumniAccordingToPresentStatus as $alumni) { ?>
                        <th><?php echo $alumni["label"]; ?></th>
                    <?php } ?>
                </thead>
                <tr>
                    <?php foreach ($alumniAccordingToPresentStatus as $alumni) { ?>
                        <td class="text-end">
                            <?php echo $alumni["y"]; ?>
                        </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <div class="d-flex flex-row align-items-center mb-2">
            <p class="m-0">Gender</p>
            <button data-bs-toggle="collapse" data-bs-target="#graph-4" id="collapse-4" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
        </div>
        <div class="collapse" id="graph-4">
            <div class="row">
                <div class="col-8">
                    <div id="graphContainer4" style="height: 370px"></div>
                </div>
                <div class="col-4">
                    <table class="table">
                        <thead>
                            <th>Male</th>
                            <th>Female</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php print_r($alumniAccordingToGender[1]["y"]); ?>
                                </td>
                                <td>
                                    <?php print_r($alumniAccordingToGender[0]["y"]); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include "script.php";
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php"; 
?>