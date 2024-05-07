<?php
session_start();

include "/xampp/htdocs/thesis/models/Alumni.php";

$alumni = new Alumni();
$id = $_GET["id"];
$presentStatus = $alumni->getPresentStatus($id);

include "/xampp/htdocs/thesis/views/template/header.php";
?>
<div class="main-body-padding" style="margin-top: 5%;">
    <div class="bg-white p-3 rounded shadow w-75 container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/thesis/alumni/profile">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/thesis/alumni/edit?id=<?php echo $id ?>">Edit</a></li>
                <li class="breadcrumb-item" aria-current="page">Present Status</li>
            </ol>
        </nav>
        <?php if ($presentStatus["presentStatus"] === "University Student") {
            include "/xampp/htdocs/thesis/views/alumni/alumni_edit/present_status/university_student.php";
        }
        ?>
        <?php if ($presentStatus["presentStatus"] === "Employed") {
            include "/xampp/htdocs/thesis/views/alumni/alumni_edit/present_status/employed.php";
        }
        ?>
    </div>
</div>

<?php include "/xampp/htdocs/thesis/views/alumni/alumni_edit/present_status/employed_script.php" ?>
<?php include "/xampp/htdocs/thesis/views/alumni/alumni_edit/present_status/university_student_script.php" ?>
<?php include "/xampp/htdocs/thesis/views/template/footer.php"; ?>