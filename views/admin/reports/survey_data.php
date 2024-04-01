<?php session_start(); ?>
<?php

include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$id = $_GET["id"];

$contents = new Contents();
$survey = $contents->getSurvey($id);
$author = $contents->getAuthor($survey["author"]);
$questions = $contents->getSurveyQuestions($survey["id"]);
$stringUtil = new StringUltilities();


?>
<?php include ("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php include ("/xampp/htdocs/thesis/views/template/admin.php"); ?>

<div class="main-body-padding admin-views">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item" href="/thesis/admin/reports">
            <a class="nav-link" aria-current="page" href="/thesis/admin/reports">Alumni</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/thesis/admin/reports/tracer">Tracer study</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/thesis/admin/reports/survey">Survey</a>
        </li>
    </ul>
    <div class="">
        <img style="height: 300px; width: 100%; object-fit: cover;"
            src="/thesis/public/images/cover/<?php echo $survey['coverImage']; ?>" />
        <h5 class="mt-3">
            <?php echo $survey["title"]; ?>
        </h5>
        <p class="m-0"><span class="fw-semibold">Created on:</span>
            <?php echo $stringUtil->dateAndTime($survey["dateCreated"]) ?>
        </p>
        <p class="m-0"><span class="fw-semibold">Last update:</span>
            <?php
            if (isset ($survey["dateUpdated"])) {
                echo $stringUtil->dateAndTime($survey["dateUpdated"]);
            } else {
                echo "not yet updated";
            } ?>
        </p>
        <p><span class="fw-semibold">Created by:</span>
            <?php echo $author["firstName"] . " " . $author["lastName"]; ?>
        </p>
        <div>
            <?php echo $survey["description"]; ?>
        </div>

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

<?php include ("/xampp/htdocs/thesis/views/template/footer.php"); ?>