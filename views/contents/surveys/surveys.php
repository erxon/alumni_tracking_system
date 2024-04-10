<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$surveys = $content->getSurveys();
$stringUtil = new StringUltilities();
?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/views/contents/layout/header.php";
?>
<div class="mt-4 py-3">
    <a role="button" class="btn btn-sm btn-dark mb-2" href="/thesis/contents/surveys">
        <i class="fas fa-question me-2"></i>Survey
    </a>
    <div id="surveys-container" class="row g-2">
        <?php foreach ($surveys as $survey) { ?>
            <div class="col-4">
                <div class="card p-0">
                    <input hidden id="cover-image-<?php echo $survey[0] ?>" value="<?php echo $survey[5] ?>" />
                    <img style="height: 7rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey[5]; ?>" class="card-img-top">
                    <div class="card-body" style="height: 120px;">
                        <h5 class="card-title m-0"><?php echo $survey[1]; ?></h5>
                        <p style="font-size: 14px;" class="m-0"><?php
                                                                $dateCreated = $stringUtil->dateAndTime($survey[4]);
                                                                echo $dateCreated;
                                                                ?></p>

                    </div>
                    <div class="card-footer d-flex">
                        <div class="w-100"><a href="/thesis/contents/surveys?id=<?php echo $survey[0]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                        <a role="button" href="/thesis/contents/surveys/edit?id=<?php echo $survey[0]; ?>" class="btn btn-sm btn-outline-secondary me-2"><i class="far fa-edit"></i></a>
                        <button onclick="deleteSurvey(<?php echo $survey[0]; ?>)" data-bs-toggle="modal" data-bs-target="#delete-survey-confirm" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="modal fade" id="delete-survey-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete survey</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this survey?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button data-bs-dismiss="modal" id="confirm-survey-delete" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
include "script.php";
include("/xampp/htdocs/thesis/views/template/footer.php");
?>