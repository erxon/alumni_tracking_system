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
                                    <th scope="col">Did not continue to college</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.Academic.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.Academic.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.Academic.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.Academic.entrepreneurship}</td>
                                    <td class="number-of-alumni" id="did_not_continue_to_college"><!--Did not continue to college-->${response.table.Academic.did_not_continue_to_college}</td>
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
                                    <th scope="col">Did not continue to college</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.TVL.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.TVL.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.TVL.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.TVL.entrepreneurship}</td>
                                    <td class="number-of-alumni" id="did_not_continue_to_college"><!--Did not continue to college-->${response.table.Academic.did_not_continue_to_college}</td>
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