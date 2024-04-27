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

    $("#collapse-1").on("click", () => {
        open.collapse1 = !open.collapse1;
        collapseButton(open.collapse1, "#collapse-1");

        if (open.collapse1) {
            graphContainer1.render();
        }
    });
    $("#collapse-2").on("click", () => {
        open.collapse2 = !open.collapse2;
        collapseButton(open.collapse2, "#collapse-2");

        if (open.collapse2) {
            academicTrackGraph.render();
            tvlTrackGraph.render();
            graphContainer2.render();
        }

    });
    $("#collapse-3").on("click", () => {
        open.collapse3 = !open.collapse3;
        collapseButton(open.collapse3, "#collapse-3");

        graphContainer3.render();
    });

    $("#collapse-4").on("click", () => {
        open.collapse4 = !open.collapse4;
        collapseButton(open.collapse4, "#collapse-4");

        graphContainer4.render();
    });



    $("#alumni-records-print").on("click", () => {
        $("#printing-spinner").show();

        const collapsibles = document.querySelectorAll(".collapse");
        const collapseList = [...collapsibles].map((collapsibleElement) => {
            new bootstrap.Collapse(collapsibleElement);
        });

        graphContainer1.render();
        academicTrackGraph.render();
        tvlTrackGraph.render();
        graphContainer2.render();
        graphContainer3.render();
        graphContainer4.render();

        setInterval(() => {
            print("alumni-records-report", "alumni-records-report");
        }, 5000);
        
        $("#printing-spinner").hide();
    });
</script>