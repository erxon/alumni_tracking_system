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

                //table manipulation
                console.log(response.table);

                $(".batch-filter").empty();
                $(".batch-filter").append(`${Number(filter) - 1}-${Number(filter)}`);
                $(".number-of-alumni").empty();

                $("#table-container-academic").empty();
                $("#table-container-tvl").empty();

                $("#table-container-academic").append(`
                        <div>
                            <h5 class="mb-4">Total Number of SHS Graduates ${Number(filter) - 1}-${Number(filter)} Academic Track</h5>
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Higher Education</th>
                                    <th scope="col">Employment</th>
                                    <th scope="col">Middle Level Skills Development</th>
                                    <th scope="col">Entrepreneurship</th>
                                    <th scope="col">None</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.Academic.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.Academic.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.Academic.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.Academic.entrepreneurship}</td>
                                    <td class="number-of-alumni" id="none"><!--Did not continue to college-->${response.table.Academic.none}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        `);

                $("#table-container-tvl").append(`
                        <div>
                            <h5 class="mb-4">Total Number of SHS Graduates ${Number(filter) - 1}-${Number(filter)} TVL Track </h5>
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Higher Education</th>
                                    <th scope="col">Employment</th>
                                    <th scope="col">Middle Level Skills Development</th>
                                    <th scope="col">Entrepreneurship</th>
                                    <th scope="col">None</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Number of graduates</th>
                                    <td class="number-of-alumni" id="higher-education"><!--Higher Education-->${response.table.TVL.higher_education}</td>
                                    <td class="number-of-alumni" id="employment"><!--Employment-->${response.table.TVL.employment}</td>
                                    <td class="number-of-alumni" id="middle-level"><!--Middle Level Skills Development-->${response.table.TVL.middle_level_skills_development}</td>
                                    <td class="number-of-alumni" id="entrepreneurship"><!--Entrepreneurship-->${response.table.TVL.entrepreneurship}</td>
                                    <td class="number-of-alumni" id="did_not_continue_to_college"><!--Did not continue to college-->${response.table.TVL.none}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        `);
            }

        });
    });
    //print
    $("#print-tracer-report").on("click", () => {
        print("tracer-study-reports", "tracer-study-reports");
        
    });

    $("#skills-print").on("click", (event) => {
        print("skills", "skills");
    });

</script>