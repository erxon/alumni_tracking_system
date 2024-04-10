<?php session_start(); ?>
<?php

include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$id = $_GET["id"];

$contents = new Contents();
$survey = $contents->getSurvey($id);
$questions = $contents->getSurveyQuestions($survey["id"]);
$stringUtil = new StringUltilities();
?>

<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>

<div class="row">
    <img class="mb-3 rounded" style="height: 300px; width: 100%; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey['coverImage']; ?>" />
    <div class="col-8">
        <div>
            <!--TABLE-->
            <div class="p-3 bg-white shadow">
                <table class="table">
                    <thead>
                        <th>Question</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($questions as $question) {
                            $answers = $contents->getSurveyAnswers($question[0]); ?>
                            <tr>
                                <td>
                                    <?php echo $question[1]; ?>
                                </td>
                                <td>
                                    <table class="table">
                                        <thead>
                                            <th>Answer</th>
                                            <th>Vote</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($answers as $answer) {
                                                $votes = $contents->getVotesByAnswer($answer[2]);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $answer[1]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $votes ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-white rounded p-3">
            <h3>
                <?php echo $survey["title"]; ?>
            </h3>
            <p style="font-size: 14px;" class="m-0"><span class="fw-semibold">Created on:</span>
                <?php echo $stringUtil->dateAndTime($survey["dateCreated"]) ?>
            </p>
            <p style="font-size: 14px;" class="m-0"><span class="fw-semibold">Last update:</span>
                <?php
                if (isset($survey["dateUpdated"])) {
                    echo $stringUtil->dateAndTime($survey["dateUpdated"]);
                } else {
                    echo "not yet updated";
                } ?>
            </p>
            <div>
                <?php echo $survey["description"]; ?>
            </div>
        </div>
    </div>
</div>
<?php
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include("/xampp/htdocs/thesis/views/template/footer.php");
?>