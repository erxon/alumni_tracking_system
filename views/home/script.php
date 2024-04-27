<script>
    window.onload = () => {
        const axisOptions = {
            titleFontFamily: "Poppins",
            titleFontWeight: "bold",
            labelFontFamily: "Poppins",
        };

        const title = {
            fontFamily: "Poppins",
            fontWeight: "bolder",
            fontSize: 18,
            margin: 16
        }
        CanvasJS.addColorSet("matUIColors",
            [ //colorSet Array
                "#f44336",
                "#2196f3",
                "#4caf50",
                "#795548",
                "#673ab7",
                "#ffeb3b",
                "#009688"
            ]);

        var batch = new CanvasJS.Chart("batch", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Batch or Year Graduated",
                ...title
            },
            axisY: {
                includeZero: true,
                title: "Number of Alumni",
                ...axisOptions
            },
            axisX: {
                includeZero: true,
                title: "Year",
                ...axisOptions
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($batchOrYear, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var tvl = new CanvasJS.Chart("tvl", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "TVL Track",
                ...title
            },
            legend: {
                cursor: "pointer",
                horizontalAlign: "left",
                verticalAlign: "center"
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                showInLegend: true,
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($accordingToStrand["TVL"], JSON_NUMERIC_CHECK); ?>
            }]
        });

        var academic = new CanvasJS.Chart("academic", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Academic Track",
                ...title
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($accordingToStrand["Academic"], JSON_NUMERIC_CHECK); ?>
            }]
        });

        var presentStatus = new CanvasJS.Chart("present-status", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Present Status",
                ...title
            },
            axisY: {
                includeZero: true,
                title: "Alumni",
                ...axisOptions
            },
            axisX: {
                includeZero: true,
                title: "Present Status",
                ...axisOptions
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($accordingToPresentStatus, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var curriculumExit = new CanvasJS.Chart("curriculum-exit", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Curriculum Exit",
                ...title
            },
            axisY: {
                includeZero: true,
                title: "Alumni",
                ...axisOptions
            },
            axisX: {
                includeZero: true,
                title: "Curriculum Exit",
                ...axisOptions
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($curriculumExit, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var skills = new CanvasJS.Chart("skills", {
            colorSet: "matUIColors",
            animationEnabled: true,
            title: {
                text: "Relevance of the skills acquired",
                ...title
            },
            axisY: {
                title: "Alumni",
                ...axisOptions
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                showInLegend: true,
                name: "Strongly Agree",
                dataPoints: <?php echo json_encode($skillsAcquired["Strongly Agree"], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "column",
                indexLabel: "{y}",
                showInLegend: true,
                name: "Agree",
                dataPoints: <?php echo json_encode($skillsAcquired["Agree"], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "column",
                indexLabel: "{y}",
                showInLegend: true,
                name: "Fairly Agree",
                dataPoints: <?php echo json_encode($skillsAcquired["Fairly Agree"], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "column",
                indexLabel: "{y}",
                showInLegend: true,
                name: "Disagree",
                dataPoints: <?php echo json_encode($skillsAcquired["Disagree"], JSON_NUMERIC_CHECK); ?>
            }]
        });
        batch.render();
        tvl.render();
        academic.render();
        presentStatus.render();
        curriculumExit.render();
        skills.render();
    }
</script>