<?php 
include("/xampp/htdocs/thesis/models/Database.php");
include("/xampp/htdocs/thesis/models/Reports.php");

$reports = new Reports();
$curriculumExits;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["filter"])){
        $curriculumExits = $reports->getCurriculumExits($_POST["filter"]);
        echo json_encode(array("result"=>$curriculumExits));
    }
}