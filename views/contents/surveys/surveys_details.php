<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

$id = $_GET["id"];

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$survey = $content->getSurveyQuestion($id);
$answers = $content->getSurveyAnswers($id);
$stringUtil = new StringUltilities();

if (isset($_POST["delete-action"])) {
    $result = $content->deleteSurvey($id);

    if ($result) {
        header("Location: /thesis/contents/surveys/all");
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="row w-75 m-auto">
        <div>
            <div class="d-flex align-items-center">
                <h5 class="m-0 me-2"><?php echo $survey["question"] ?></h5>
                <?php if (
                    isset($_SESSION["type"]) &&
                    $_SESSION["type"] == "admin" &&
                    $_SESSION["user_id"] ==
                    $survey["author"]
                ) { ?>
                    <a role="button" href="/thesis/contents/surveys/edit?id=<?php echo $survey["id"]; ?>" class="btn btn-sm btn-light me-1"><i class="fas fa-pen"></i></a>
                    <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#on-delete-confirm"><i class="fas fa-trash"></i></button>
                <?php } ?>
            </div>
            <p class="label mb-0">Survey Created on</p>
            <p style="font-size: 14px;"><i class="far fa-clock"></i> <?php
                                                                        $dateCreated = $stringUtil->dateAndTime($survey["dateCreated"]);
                                                                        echo $dateCreated;
                                                                        ?></p>
        </div>
        <div class="col-lg-8">
            <!--Survey body-->
            <img class="mb-3" style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey["coverImage"] ?>" />
            <?php echo $survey["body"] ?>
        </div>
        <div class="col-lg-4">
            <!--Survey choices-->
            <p style="font-weight: 600;">Choices</p>
            <?php foreach ($answers as $answer) { ?>
                <p><?php echo $answer[2]; ?></p>
            <?php } ?>
        </div>
    </div>
</div>
<form method="post">
    <input hidden name="delete-action" value="delete" />
    <div class="modal fade" id="on-delete-confirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this survey?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>