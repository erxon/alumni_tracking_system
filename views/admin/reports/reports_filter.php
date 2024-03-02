<?php
include("/xampp/htdocs/thesis/models/Database.php");
include("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$curriculumExits;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["filter"])) {
        /** 
         * 
         * table: { 
         *  Academic: {
         *      strand: {
         *          curriculumExits
         *      },...
         *  },
         *  TVL: {
         *      strand: {
         *          curriculumExits
         *      },...
         *  } 
         * }
         * **/

        $table = array("Academic" => array(), "TVL" => array());
        $curriculumExits = $reports->getCurriculumExits($_POST["filter"]);
        $strandsInAcademicTrack = $reports->getAlumniByTrack($_POST["filter"], 'Academic');
        $strandsInTvlTrack = $reports->getAlumniByTrack($_POST["filter"], 'TVL',);

        foreach ($strandsInAcademicTrack as $strand) {
            $temp = array("label"=>"", "values"=>array());
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted($_POST["filter"], 'Academic', $strand[1]);

            $temp["label"] = $strand[1];
            $temp["values"] = $curriculumExitsUnformatted;

            array_push($table["Academic"], $temp);
        }

        foreach ($strandsInTvlTrack as $strand) {
            $temp = array("label"=>"", "values"=>array());
            $curriculumExitsUnformatted = $reports->getCurriculumExitsUnformatted($_POST["filter"], 'TVL', $strand[1]);

            
            $temp["label"] = $strand[1];
            $temp["values"] = $curriculumExitsUnformatted;

            array_push($table["TVL"], $temp);
        }

        echo json_encode(array("result" => $curriculumExits, "table" => $table));
    }
}
