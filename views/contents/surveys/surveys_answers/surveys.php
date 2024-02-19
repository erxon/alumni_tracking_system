<?php
session_start();
include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$contents = new Contents();
$stringUtil = new StringUltilities();
$surveys = $contents->getSurveys();
$userId = $_SESSION["user_id"];

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding" style="margin-top: 48px">
    <h3>Surveys</h3>
    <div class="row">
        <?php foreach ($surveys as $survey) { ?>
            <div class="col-4">
                <div class="card">
                    <img style="height: 200px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey[1]; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?php echo $survey[2] ?></h5>
                        <p class="card-subtitle text-secondary mb-0"><?php echo $stringUtil->dateAndTime($survey[5]); ?></p>
                        <p class="card-text"><?php echo $survey[7] ?></p>
                        <?php if ($contents->hasVoted($userId, $survey[0])) { ?>
                            <p style="font-size: 14px;" class="bg-success-subtle text-emphasis-success p-2 rounded">You already answered this survey</p>
                        <?php } ?>
                        <a href="/thesis/surveys/answers?id=<?php echo $survey[0]; ?>" class="btn btn-dark">Answer survey</a>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>