<?php
require "/xampp/htdocs/thesis/models/Users.php";
require "/xampp/htdocs/thesis/models/Fields.php";
require "/xampp/htdocs/thesis/models/SchoolInformation.php";


$field = new Fields();
$user = new Users();

$additionalInformation = array_reverse($field->getFields()->fetch_all());

$schoolInformation = new SchoolInformation();
$tracks = $schoolInformation->getTracks();
$strands = $schoolInformation->getStrands();
$specializations = $schoolInformation->getSpecializations();
$users = $user->getAllUsers();

include("/xampp/htdocs/thesis/views/template/header.php");
?>


<?php include "data.php"; ?>

<div class="registration-form">
    <form id="alumni-registration-form" class="container m-auto p-2" novalidate>
        <h1>Alumni Registration</h1>
        <p id="page-number-paragraph">Page <span id="page-number">1</span> of 3</p>
        <div class="progress my-3" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" id="progress-bar" style="width: 25%"></div>
        </div>
        <div id="form-page-1" class="mb-3">
            <div class="bg-white rounded p-3 shadow-sm mb-3">
                <h5>Personal information</h5>
                <hr class="my-3" />
                <?php include "personal_information.php" ?>
            </div>
            <div class="rounded bg-white p-3 shadow-sm mb-3">
                <h5>Track and Strand Finished</h5>
                <hr class="my-3" />
                <?php include "school_information.php" ?>
            </div>
            <div class="rounded bg-white p-3 shadow-sm mb-3">
                <h5>Present status</h5>
                <hr class="my-3" />
                <?php include "present_status.php" ?>
            </div>
            <div class="bg-white rounded p-3 shadow-sm mb-3">
                <h5>Additional information</h5>
                <hr />
                <?php include "additional_information.php" ?>
            </div>
        </div>
        <div id="form-page-2" class="mb-3" style="display:none">
            <?php include "pursued_curriculum_exits.php"; ?>
        </div>
        <div id="form-page-3" class="mb-3" style="display:none">
            <?php include "tracer_study.php"; ?>
        </div>
        <button id="alumni-form-previous-button" type="button" class="btn btn-outline-dark btn-sm" disabled><i class="fas fa-arrow-left"></i> Previous</button>
        <button id="alumni-form-next-button" type="submit" class="btn btn-outline-dark btn-sm"><span id="alumni-form-proceed-text">Next</span> <i class="fas fa-arrow-right"></i></button>
    </form>
    <div style="display: none;" id="success-message" class="alert alert-success w-75 container-fluid shadow p-3 rounded">
        <h2>You have successfully registered</h2>
        <p>Registration has been submitted and is subject for
            approval. A confirmation email will be sent to you
            once approved. Thank you.</p>
    </div>
</div>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>