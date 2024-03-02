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

<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>

<div class="main-body-padding admin-views">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item" href="/thesis/admin/reports">
            <a class="nav-link active" aria-current="page" href="/thesis/admin/reports">Alumni</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/thesis/admin/reports/tracer">Tracer study</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/thesis/admin/reports/survey">Survey</a>
        </li>
        <a role="button" class="btn btn-sm btn-dark ms-auto" href="/thesis/admin/reports/print"><i class="fas fa-print"></i> Print</a>
    </ul>

    <div>
        <div class="mb-2">
            <div class="d-flex flex-row align-items-center mb-2">
                <p class="m-0">Number of Alumni according to Batch/Year Graduated</p>
                <button data-bs-toggle="collapse" data-bs-target="#graph-1" id="collapse-1" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
            </div>
            <div class="collapse" id="graph-1">
                <div id="graphContainer1" style="height: 370px; width: 100%"></div>
            </div>
        </div>
        <div class="mb-2">
            <div class="d-flex flex-row align-items-center mb-2">
                <p class="m-0">Number of Alumni according to track and strand (Pie graph)</p>
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
                                <th>Academic</th>
                                <th>TVL</th>
                            </thead>
                            <tr>
                                <th scope="row">Alumni</th>
                                <td><?php echo $alumniAccordingToTrackNumeric["Academic"] ?></td>
                                <td><?php echo $alumniAccordingToTrackNumeric["TVL"] ?></td>
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
                                <th>Alumni</th>
                            </thead>
                            <tr>
                                <?php foreach ($alumniAccordingToStrandNumeric["TVL"] as $strand) { ?>
                                    <td><?php echo $strand["label"] ?></td>
                                    <td><?php echo $strand["y"]; ?></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div id="academicTrackGraph" style="height: 300px;"></div>
                        <table class="table mt-2">
                            <thead>
                                <th>Strand</th>
                                <th>Alumni</th>
                            </thead>
                            <tr>
                                <?php foreach ($alumniAccordingToStrandNumeric["Academic"] as $strand) { ?>
                                    <td><?php echo $strand["label"] ?></td>
                                    <td><?php echo $strand["y"]; ?></td>
                                <?php } ?>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <div class="d-flex flex-row align-items-center mb-2">
                <p class="m-0">Number of Alumni according to present status</p>
                <button data-bs-toggle="collapse" data-bs-target="#graph-3" id="collapse-3" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
            </div>
            <div class="collapse" id="graph-3">
                <div id="graphContainer3" style="height: 370px"></div>
            </div>
        </div>
        <div>
            <div class="d-flex flex-row align-items-center mb-2">
                <p class="m-0">Number of Alumni according to gender</p>
                <button data-bs-toggle="collapse" data-bs-target="#graph-4" id="collapse-4" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-caret-down"></i></button>
            </div>
            <div class="collapse" id="graph-4">
                <div id="graphContainer4" style="height: 370px"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let open = {
        collapse1: false,
        collapse2: false,
        collapse3: false,
        collapse4: false,
    };

    const collapseButton = (open, id) => {
        if (open) {
            $(id).empty();
            $(id).append(`<i class="fas fa-caret-up"></i>`);

        } else {
            $(id).empty();
            $(id).append(`<i class="fas fa-caret-down"></i>`);
        }
    }

    $("#collapse-1").on("click", () => {
        open.collapse1 = !open.collapse1;
        collapseButton(open.collapse1, "#collapse-1");

        var graphContainer1 = new CanvasJS.Chart("graphContainer1", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            axisY: {
                includeZero: true,
                title: "Number of Alumni"
            },
            axisX: {
                includeZero: true,
                title: "Year"
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($numberOfAlumniPerYear, JSON_NUMERIC_CHECK); ?>
            }]
        });

        if (open.collapse1) {
            graphContainer1.render();
        }
    });
    $("#collapse-2").on("click", () => {
        open.collapse2 = !open.collapse2;
        collapseButton(open.collapse2, "#collapse-2");

        var graphContainer2 = new CanvasJS.Chart("graphContainer2", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Number of Alumni According to Track"
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($alumniAccordingToTrack, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var academicTrackGraph = new CanvasJS.Chart("academicTrackGraph", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Academic Track"
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($alumniAccordingToStrand["Academic"], JSON_NUMERIC_CHECK); ?>
            }]
        });

        var tvlTrackGraph = new CanvasJS.Chart("tvlTrackGraph", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "TVL Track"
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($alumniAccordingToStrand["TVL"], JSON_NUMERIC_CHECK); ?>
            }]
        });

        if (open.collapse2) {
            academicTrackGraph.render();
            tvlTrackGraph.render();
            graphContainer2.render();
        }

    });
    $("#collapse-3").on("click", () => {
        open.collapse3 = !open.collapse3;
        collapseButton(open.collapse3, "#collapse-3");

        var graphContainer3 = new CanvasJS.Chart("graphContainer3", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            axisY: {
                includeZero: true,
                title: "Alumni"
            },
            axisX: {
                includeZero: true,
                title: "Present Status"
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($alumniAccordingToPresentStatus, JSON_NUMERIC_CHECK); ?>
            }]
        });

        graphContainer3.render();
    });
    $("#collapse-4").on("click", () => {
        open.collapse4 = !open.collapse4;
        collapseButton(open.collapse4, "#collapse-4");

        var graphContainer4 = new CanvasJS.Chart("graphContainer4", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            axisY: {
                includeZero: true,
                title: "Alumni"
            },
            axisX: {
                includeZero: true,
                title: "Gender"
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#",
                dataPoints: <?php echo json_encode($alumniAccordingToGender, JSON_NUMERIC_CHECK); ?>
            }]
        });

        graphContainer4.render();
    });
</script>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>