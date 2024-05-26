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
<div>
    <button id="print-survey-data" class="btn btn-sm btn-dark"><i class="fas fa-print"></i> Print</button>
    <nav aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/admin/survey?id=<?php echo $id; ?>">Data</a></li>
            <li class="breadcrumb-item" aria-current="page">Print preview</li>
        </ol>
    </nav>
    <hr class="my-3" />
    <h5>Print preview</h5>
    <div id="survey-data" class="bg-white shadow p-3 mb-3">
        <div>
            <div class="print-area">
                <h3><?php echo $survey["title"] ?></h3>
                <div>
                    <!--TABLE-->
                    <div class="p-3">
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
                                            <table class="table table-striped">
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
        </div>
    </div>
</div>
<?php
include "script.php";
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include("/xampp/htdocs/thesis/views/template/footer.php");
?>