<?php session_start(); ?>
<?php include ("/xampp/htdocs/thesis/models/Database.php"); ?>
<?php

include ("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$alumni = $reports->alumni();
$curriculumExits = $reports->getCurriculumExits(0);
$strandsInAcademicTrack = $reports->getAlumniByTrack(0, 'Academic');
$strandsInTvlTrack = $reports->getAlumniByTrack(0, 'TVL', );
$questions = $reports->getAlumniRatingsPerQuestion();
$currentYear = date("Y");

?>
<?php include ("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php include ("/xampp/htdocs/thesis/views/template/admin.php"); ?>


<div class="main-body-padding admin-views">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/thesis/admin/reports">Alumni</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/thesis/admin/reports/tracer">Tracer study</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/thesis/admin/reports/survey">Survey</a>
        </li>
    </ul>
    <div class="d-flex mb-2">
        <form id="custom-filter" class="d-flex me-2 align-items-center">
            <input id="custom-filter-year-1" name="custom-filter-year-1" type="number" class="form-control me-2" />
            <p class="m-0 me-2">-</p>
            <input id="custom-filter-year-2" name="custom-filter-year-2" type="number" class="form-control me-3" />
            <button disabled id="filter-graph" type="submit" class="btn btn-sm btn-dark me-2">Filter</button>
            <button id="refresh-graph" type="button" class="btn btn-sm btn-outline-dark w-50"><i
                    class="fas fa-redo"></i> Clear</button>
        </form>
    </div>
    <div class="bar-graph-container p-3 rounded shadow bg-white mb-3">
        <div id="bar-graph" style="height: 300px; width: 100%;"></div>
        <!--Iterate this table -->
        <div id="table-container-academic">
            <?php
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'Academic');
            ?>
            <div class="mt-3">
                <p>Total Number of SHS Graduates <span class="batch-filter"></span> Academic Track</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Higher Education</th>
                            <th scope="col">Employment</th>
                            <th scope="col">Middle Level Skills Development</th>
                            <th scope="col">Entrepreneurship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of graduates</th>
                            <td class="number-of-alumni" id="higher-education"><!--Higher Education-->
                                <?php echo $curriculumExitsUnformatted["higher_education"] ?>
                            </td>
                            <td class="number-of-alumni" id="employment"><!--Employment-->
                                <?php echo $curriculumExitsUnformatted["employment"] ?>
                            </td>
                            <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->
                                <?php echo $curriculumExitsUnformatted["middle_level_skills_development"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["entrepreneurship"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="table-container-tvl">
            <?php
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted(0, 'TVL');
            ?>
            <div class="mt-3">
                <p>Total Number of SHS Graduates <span class="batch-filter"></span> TVL Track </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Higher Education</th>
                            <th scope="col">Employment</th>
                            <th scope="col">Middle Level Skills Development</th>
                            <th scope="col">Entrepreneurship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Number of graduates</th>
                            <td class="number-of-alumni" id="higher-education"><!--Higher Education-->
                                <?php echo $curriculumExitsUnformatted["higher_education"] ?>
                            </td>
                            <td class="number-of-alumni" id="employment"><!--Employment-->
                                <?php echo $curriculumExitsUnformatted["employment"] ?>
                            </td>
                            <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->
                                <?php echo $curriculumExitsUnformatted["middle_level_skills_development"] ?>
                            </td>
                            <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->
                                <?php echo $curriculumExitsUnformatted["entrepreneurship"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                    <p class="text-center mt-3 fw-semibold">
                        <?php echo $titles[$i]; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    let filter = "all";
    const date = new Date();
    let currentYear = date.getFullYear();

    $("#date-graduated").on("change", (event) => {
        filter = event.target.value;
    });

    $("#custom-filter-year-1").keyup(() => {
        if ($("#custom-filter-year-1").val() < 2000 || $("#custom-filter-year-1").val() >= currentYear) {
            $("#custom-filter-year-1").addClass("border border-danger");
            $("#custom-filter-year-2").addClass("border border-danger");

            $("#filter-graph").prop("disabled", true);

            $("#custom-filter-year-2").val("");
        } else {
            $("#custom-filter-year-1").removeClass("border border-danger");
            $("#custom-filter-year-2").removeClass("border border-danger");
            $("#custom-filter-year-1").addClass("border border-success");
            $("#custom-filter-year-2").addClass("border border-success");

            $("#filter-graph").prop("disabled", false);

            $("#custom-filter-year-2").val(Number($("#custom-filter-year-1").val()) + 1);
        }
    });

    $("#custom-filter-year-2").keyup(() => {
        if ($("#custom-filter-year-2").val() < 2000 || $("#custom-filter-year-2").val() > currentYear) {
            $("#custom-filter-year-1").addClass("border border-danger");
            $("#custom-filter-year-2").addClass("border border-danger");

            $("#filter-graph").prop("disabled", true);

            $("#custom-filter-year-1").val("");
        } else {
            $("#custom-filter-year-1").removeClass("border border-danger");
            $("#custom-filter-year-2").removeClass("border border-danger");
            $("#custom-filter-year-1").addClass("border border-success");
            $("#custom-filter-year-2").addClass("border border-success");

            $("#filter-graph").prop("disabled", false);

            $("#custom-filter-year-1").val(Number($("#custom-filter-year-2").val()) - 1);
        }
    });

    $("#refresh-graph").on("click", () => {
        location.reload();
        return;
    });

    $("#custom-filter").on("submit", (event) => {
        event.preventDefault();

        if ($("#custom-filter-year-1").val() !== "" &&
            $("#custom-filter-year-2").val() !== "") {
            filter = $("#custom-filter-year-2").val();
        }

        const data = new FormData();
        data.append("filter", filter);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/reports/filter`,
            dataType: "json",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.result.length === 0) {
                    $("#bar-graph").empty();
                    $("#bar-graph").append(`<p class="text-secondary">No graph to show</p>`);
                } else {
                    var barGraph = new CanvasJS.Chart("bar-graph", {
                        exportEnabled: true,
                        data: [{
                            type: "column",
                            yValueFormatString: "#, alumni",
                            dataPoints: response.result
                        }]
                    });
                    barGraph.render();

                    //table manipulation
                    console.log(response.table);

                    $(".batch-filter").empty();
                    $(".batch-filter").append(`${Number(filter) - 1}-${Number(filter)}`);
                    $(".number-of-alumni").empty();

                    $("#table-container-academic").empty();
                    $("#table-container-tvl").empty();

                    $("#table-container-academic").append(`
                        <div class="mt-3">
                            <p>Total Number of SHS Graduates ${Number(filter) - 1}-${Number(filter)} Academic Track</p>
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Higher Education</th>
                                    <th scope="col">Employment</th>
                                    <th scope="col">Middle Level Skills Development</th>
                                    <th scope="col">Entrepreneurship</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.Academic.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.Academic.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.Academic.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.Academic.entrepreneurship}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        `);

                    $("#table-container-academic").append(`
                        <div class="mt-3">
                            <p>Total Number of SHS Graduates ${Number(filter) - 1}-${Number(filter)} TVL Track </p>
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Higher Education</th>
                                    <th scope="col">Employment</th>
                                    <th scope="col">Middle Level Skills Development</th>
                                    <th scope="col">Entrepreneurship</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.TVL.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.TVL.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.TVL.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.TVL.entrepreneurship}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        `);

                }

            }

        });
    });

    window.onload = function () {
        var barGraph = new CanvasJS.Chart("bar-graph", {
            exportEnabled: true,
            data: [{
                type: "column",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($curriculumExits, JSON_NUMERIC_CHECK); ?>
            }]
        });
        barGraph.render();

        var chart1 = new CanvasJS.Chart(`chart-container-0`, {
            animationEnabled: true,
            exportEnabled: true,
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
            exportEnabled: true,
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
            exportEnabled: true,
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
            exportEnabled: true,
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

<?php include ("/xampp/htdocs/thesis/views/template/footer.php"); ?>