<script>
    // $("#filter-graph").on("submit", (event) => {
    //     const formData = new FormData(event.target);


    // });

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
    window.onload = () => {

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

        var graduatesPerStrand = new CanvasJS.Chart("batch", {
            animationEnabled: true,
            colorSet: "matUIColors",
            title: {
                text: "Graduates Per Strand",
                ...title
            },
            axisY: {
                title: "Strand",
                includeZero: true,
            },
            data: [{
                setInterval: 1,
                type: "bar",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($graduatesPerStrand, JSON_NUMERIC_CHECK); ?>
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

        var gender = new CanvasJS.Chart("gender", {
            colorSet: "matUIColors",
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            title: {
                text: "Gender",
                ...title
            },
            axisY: {
                includeZero: true,
                title: "Alumni",
                ...axisOptions
            },
            axisX: {
                includeZero: true,
                title: "Gender",
                ...axisOptions
            },
            data: [{
                type: "column",
                indexLabel: "{y}",
                yValueFormatString: "#, alumni",
                dataPoints: <?php echo json_encode($gender, JSON_NUMERIC_CHECK); ?>
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

        

        graduatesPerStrand.render();
        presentStatus.render();
        curriculumExit.render();
        gender.render();
        skills.render();
    }
</script>