<?php

require("/xampp/htdocs/thesis/vendor/tecnickcom/tcpdf/tcpdf.php");

include("/xampp/htdocs/thesis/models/Database.php");
include("/xampp/htdocs/thesis/models/Reports.php");


$reports = new Reports();
$alumni = $reports->alumni();
$curriculumExits = $reports->getCurriculumExits(0);
$strandsInAcademicTrack = $reports->getAlumniByTrack(0, 'Academic');
$strandsInTvlTrack = $reports->getAlumniByTrack(0, 'TVL',);
$questions = $reports->getAlumniRatingsPerQuestion();
$currentYear = date("Y");

$pdf = new TCPDF();

$pdf->AddPage();

$pdf->writeHTML('<div class="mb-2">

<div class="d-flex flex-row align-items-center mb-2">
    <p class="m-0">Number of Alumni according to Batch/Year Graduated</p>
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
                </thead>');
foreach ($numberOfAlumniPerYear as $batch) {
    $pdf->writeHTML('<tr>
                    <td><?php echo $batch["label"]; ?></td>
                    <td class="text-end"><?php echo $batch["y"]; ?></td>
                </tr>');
}

$pdf->writeHTML('</table>
</div>
</div>
</div>
</div>
');

$js = '
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
});';

$pdf->IncludeJS($js);


$pdf->Output();
