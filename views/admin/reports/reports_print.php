<?php

require "/xampp/htdocs/thesis/vendor/tecnickcom/tcpdf/tcpdf.php";
include("/xampp/htdocs/thesis/models/Reports.php");
include("/xampp/htdocs/thesis/models/Database.php");



$reports = new Reports();
$numberOfAlumniPerYear = $reports->numberOfAlumniPerYear();

$pdf = new TCPDF();

$pdf->AddPage();

$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a29e11090c.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="/thesis/vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <link rel="stylesheet" href="/thesis/public/styles.css" />
  <title>Alumni Tracker</title>
</head>
<body>
  <header class="header">
    <?php include("navbar.php") ?>
  </header>
  <main>
    <div class="d-flex flex-row align-items-center mb-2">
        <p class="m-0">Number of Alumni according to Batch/Year Graduated</p>
    </div>
    <div id="graphContainer1" style="height: 370px; width: 100%"></div>
  </main>
  </body></html>';

$pdf->writeHTML($html);

$dataPoints = json_encode($numberOfAlumniPerYear, JSON_NUMERIC_CHECK);

$js = <<<EOD
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
        dataPoints: $dataPoints
    }]
});

graphContainer1.render();
EOD;


$pdf->IncludeJS($js);


$pdf->Output('reports.pdf', 'I');
