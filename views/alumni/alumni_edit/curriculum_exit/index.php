<?php
session_start();

include "/xampp/htdocs/thesis/models/Alumni.php";

$alumni = new Alumni();
$id = $_GET["id"];
$curriculumExit = $alumni->getCurriculumExit($id);

include "/xampp/htdocs/thesis/views/template/header.php";
?>
<div class="main-body-padding" style="margin-top: 5%;">
    <div class="bg-white p-3 rounded shadow w-75 container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/thesis/alumni/profile">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/thesis/alumni/edit?id=<?php echo $id ?>">Edit</a></li>
                <li class="breadcrumb-item" aria-current="page">Curriculum Exit</li>
            </ol>
        </nav>
        <?php 
        if ($curriculumExit["pursuedCurriculumExit"] === "Employment") {
            include "employment.php";
        }
        if ($curriculumExit["pursuedCurriculumExit"] === "Higher Education") {
            include "higher_education.php";
        }
        if ($curriculumExit["pursuedCurriculumExit"] === "Entrepreneurship") {
            include "entrepreneurship.php";
        }
        if ($curriculumExit["pursuedCurriculumExit"] === "Middle-level skills development") {
            include "mid_level.php";
        } 
        if ($curriculumExit["pursuedCurriculumExit"] === "None") {
            include "none.php";
        }?>
    </div>
</div>


<?php
if ($curriculumExit["pursuedCurriculumExit"] === "Employment") {
    include "employment_script.php";
}
if ($curriculumExit["pursuedCurriculumExit"] === "Higher Education") {
    include "higher_education_script.php";
}
if ($curriculumExit["pursuedCurriculumExit"] === "Entrepreneurship") {
    include "entrepreneurship_script.php";
}
if ($curriculumExit["pursuedCurriculumExit"] === "Middle-level skills development") {
    include "mid_level_script.php";
}
if ($curriculumExit["pursuedCurriculumExit"] === "None") {
    include "none_script.php";
}
?>

<?php include "/xampp/htdocs/thesis/views/template/footer.php"; ?>