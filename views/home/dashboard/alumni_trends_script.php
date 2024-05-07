<script>
    window.onload = () => {
        const alumniTrendsBatches = $("#alumni-trends-batches").length;
        const alumniTrendsBatchesPerTrack = $("#alumni-trends-batches-per-track").length;
        const alumniTrendsPresentStatusAll = $("#alumni-trends-present-status-all").length;
        const alumniTrendsPresentStatus = $("#alumni-trends-present-status").length;
        const alumniTrendsCurriculumExitAll = $("#alumni-trends-curriculum-exit-all").length;
        const alumniTrendsCurriculumExit = $("#alumni-trends-curriculum-exit").length;

        if (alumniTrendsBatches) {
            var yearGraduatedTrend = new CanvasJS.Chart("alumni-trends-batches", {
                title: {
                    text: "Year Graduated"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                    type: "line",
                    name: "Academic",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($yearGraduatedTrend["ACAD"], JSON_NUMERIC_CHECK); ?>
                }, {
                    type: "line",
                    name: "Technical-Vocational and Livelihood",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($yearGraduatedTrend["TVL"], JSON_NUMERIC_CHECK); ?>
                }]
            });

            yearGraduatedTrend.render();
        }

        if (alumniTrendsBatchesPerTrack) {
            var yearGraduatedTrendTracks = new CanvasJS.Chart("alumni-trends-batches-per-track", {
                title: {
                    text: "Year Graduated"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                    type: "line",
                    name: "<?php echo $trackTrend ?>",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($yearGraduatedTrendTracks, JSON_NUMERIC_CHECK); ?>
                }]
            });

            yearGraduatedTrendTracks.render();
        }

        if (alumniTrendsPresentStatusAll) {
            var yearGraduatedPresentStatusAll = new CanvasJS.Chart("alumni-trends-present-status-all", {
                title: {
                    text: "Present Status"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                        type: "line",
                        name: "Employed",
                        setInterval: 2,
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedPresentStatusAll["employed"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "University Student",
                        setInterval: 2,
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedPresentStatusAll["university_student"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Unemployed",
                        setInterval: 2,
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedPresentStatusAll["unemployed"], JSON_NUMERIC_CHECK); ?>
                    }
                ]
            });

            yearGraduatedPresentStatusAll.render();
        }
        if (alumniTrendsPresentStatus) {
            var yearGraduatedPresentStatus = new CanvasJS.Chart("alumni-trends-present-status", {
                title: {
                    text: "Present Status"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                    type: "line",
                    name: "<?php echo $presentStatus; ?>",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($yearGraduatedPresentStatus, JSON_NUMERIC_CHECK); ?>
                }]
            });

            yearGraduatedPresentStatus.render();
        }

        if (alumniTrendsCurriculumExitAll) {
            var yearGraduatedCurriculumExitAll = new CanvasJS.Chart("alumni-trends-curriculum-exit-all", {
                title: {
                    text: "Curriculum Exit"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                        type: "line",
                        name: "Employment",
                        indexLabel: "{y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedCurriculumExitAll["employment"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Higher Education",
                        indexLabel: "{y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedCurriculumExitAll["higher_education"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Entrepreneurship",
                        indexLabel: "{y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedCurriculumExitAll["entrepreneurship"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Middle-Level skills development",
                        indexLabel: "{y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedCurriculumExitAll["mid_level"], JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "None",
                        indexLabel: "{y}",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($yearGraduatedCurriculumExitAll["none"], JSON_NUMERIC_CHECK); ?>
                    }
                ]
            });

            yearGraduatedCurriculumExitAll.render();
        }

        if (alumniTrendsCurriculumExit) {
            var yearGraduatedCurriculumExits = new CanvasJS.Chart("alumni-trends-curriculum-exit", {
                title: {
                    text: "Curriculum Exit"
                },
                axisY: {
                    title: "Alumni"
                },
                data: [{
                    type: "line",
                    name: "<?php echo $alumniTrendCurriculumExit; ?>",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($yearGraduatedCurriculumExits, JSON_NUMERIC_CHECK); ?>
                }]
            });

            yearGraduatedCurriculumExits.render();
        }
    }
</script>