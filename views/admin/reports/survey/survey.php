<?php session_start(); ?>
<?php

include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$surveys = $contents->getSurveys();
?>
<?php include "/xampp/htdocs/thesis/views/admin/reports/layout/header.php" ?>
<div>
    <table class="table">
        <thead>
            <th>No</th>
            <th>Title</th>
            <th>Number of Respondents</th>
            <th>Actions</th>
        </thead>
        <?php foreach ($surveys as $survey) {
            $votes = $contents->getVotes($survey[0]);
        ?>
            <tr>
                <th><?php echo $survey[0]; ?></th>
                <td><?php echo $survey[1]; ?></td>
                <td><?php echo $votes; ?></td>
                <td>
                    <a role="button" class="btn btn-sm btn-light" href="/thesis/admin/survey?id=<?php echo $survey[0]; ?>">View</a>
                    <a role="button" class="btn btn-sm btn-light">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include "/xampp/htdocs/thesis/views/admin/reports/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>