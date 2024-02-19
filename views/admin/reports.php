<?php session_start(); ?>
<?php include("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php

include("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$alumni = $reports->alumni();
$curriculumExits = $reports->getCurriculumExits(0);
$questions = $reports->getAlumniRatingsPerQuestion();
$currentYear = date("Y");

?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>


<div class="main-body-padding admin-views">
    <div class="d-flex mb-2">
        <select id="date-graduated" class="form-select me-2" name="dateGraduated">
            <option selected>Open this select menu</option>
            <option value="all">All</option>
            <option value=<?php echo $currentYear; ?>><?php echo ($currentYear - 1) . "-" . $currentYear; ?></option>
            <option value=<?php echo $currentYear - 1; ?>><?php echo ($currentYear - 2) . "-" . ($currentYear - 1); ?></option>
            <option value=<?php echo $currentYear - 2; ?>><?php echo ($currentYear - 3) . "-" . ($currentYear - 2); ?></option>
            <option value=<?php echo $currentYear - 3; ?>><?php echo ($currentYear - 4) . "-" . ($currentYear - 3); ?></option>
            <option value=<?php echo $currentYear - 4; ?>><?php echo ($currentYear - 5) . "-" . ($currentYear - 4); ?></option>
            <option value=<?php echo $currentYear - 5; ?>><?php echo ($currentYear - 6) . "-" . ($currentYear - 5); ?></option>
        </select>
        <button id="filter-graph" type="button" class="btn btn-sm btn-dark">Filter</button>
    </div>
    <div class="bar-graph-container p-3 rounded shadow bg-white mb-3">
        <div id="bar-graph" style="height: 300px; width: 100%;"></div>
    </div>
    <div>
        <?php
        $answerCategories = array("Disagree", "Fairly Agree", "Agree", "Strongly Agree");
        $dataPoints = array();

        for ($i = 0; $i < 4; $i++) {
            $temporaryArray = array();
        ?>
            <?php foreach ($questions[$i] as $answers) {
                array_push($temporaryArray, array("label" => $answerCategories[$answers[0] - 1], "y" => ($answers[1] / $alumni) * 100));
            ?>
            <?php } ?>
        <?php
            array_push($dataPoints, $temporaryArray);
        } ?>
        <div class="row gap-0">
            <?php
            $titles = array(
                "Information, media and technology skills",
                "Learning and innovation skills",
                "Effective communication skills",
                "Life and career skills"
            );
            for ($i = 0; $i < 4; $i++) {
            ?>
                <div class="col-6 p-3 bg-white border">
                    <div id="chart-container-<?php echo $i; ?>" style="height: 275px; width: 100%;"></div>
                    <p class="text-center mt-3 fw-semibold"><?php echo $titles[$i]; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    let filter = "";

    $("#date-graduated").on("change", (event) => {
        filter = event.target.value;
    });

    $("#filter-graph").on("click", () => {
        const data = new FormData();
        data.append("filter", filter);

        if (filter === "all") {
            var barGraph = new CanvasJS.Chart("bar-graph", {
                data: [{
                    type: "column",
                    yValueFormatString: "#, alumni",
                    dataPoints: <?php echo json_encode($curriculumExits, JSON_NUMERIC_CHECK); ?>
                }]
            });
            barGraph.render();
            return;
        }
        $.ajax({
            type: "POST",
            url: `/thesis/admin/reports/filter`,
            dataType: "json",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response.result);
                if (response.result.length === 0) {
                    $("#bar-graph").empty();
                    $("#bar-graph").append(`<p class="text-secondary">No graph to show</p>`);
                } else {
                    var barGraph = new CanvasJS.Chart("bar-graph", {
                        data: [{
                            type: "column",
                            yValueFormatString: "#, alumni",
                            dataPoints: response.result
                        }]
                    });
                    barGraph.render();
                }

            }

        });
    });

    window.onload = function() {
        var barGraph = new CanvasJS.Chart("bar-graph", {
            data: [{
                type: "column",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($curriculumExits, JSON_NUMERIC_CHECK); ?>
            }]
        });
        barGraph.render();

        var chart1 = new CanvasJS.Chart(`chart-container-0`, {
            animationEnabled: true,
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints[0], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();

        var chart2 = new CanvasJS.Chart(`chart-container-1`, {
            animationEnabled: true,
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints[1], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart2.render();

        var chart3 = new CanvasJS.Chart(`chart-container-2`, {
            animationEnabled: true,
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints[2], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart3.render();

        var chart4 = new CanvasJS.Chart(`chart-container-3`, {
            animationEnabled: true,
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints[3], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart4.render();
    }
</script>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>