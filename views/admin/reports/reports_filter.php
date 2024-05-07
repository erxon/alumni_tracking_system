<?php
include ("/xampp/htdocs/thesis/models/Database.php");
include ("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$curriculumExits;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset ($_POST["filter"])) {
        $curriculumExits = $reports->getCurriculumExits($_POST["filter"]);

        $curriculumExitsUnformattedAcademic = $reports->getCurriculumExitsUnformatted($_POST["filter"], 'Academic');
        $curriculumExitsUnformattedTVL = $reports->getCurriculumExitsUnformatted($_POST["filter"], 'Technical-Vocational and Livelihood');
        
        $table = ["Academic" => $curriculumExitsUnformattedAcademic, "TVL" => $curriculumExitsUnformattedTVL];

        echo json_encode(array("result" => $curriculumExits, "table" => $table));
    }
}
