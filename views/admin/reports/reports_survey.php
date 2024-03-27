<?php session_start(); ?>
<?php

include("/xampp/htdocs/thesis/models/Contents.php");

$contents = new Contents();
$surveys = $contents->getSurveys();


?>
<?php include("/xampp/htdocs/thesis/views/template/header.php"); ?>
<?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>

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
    <table class="table">
        <thead>
            <th>No</th>
            <th>Title</th>
            <th>Number of Respondents</th>
            <th>Actions</th>
        </thead>
        <?php foreach ($surveys as $survey) { 
            $votes = $contents->getSurveyVotes($survey[0]);
            ?>
            <tr>
                <th><?php echo $survey[0]; ?></th>
                <td><?php echo $survey[1]; ?></td>
                <td><?php echo $votes[0][1]; ?></td>
                <td>
                    <a role="button" class="btn btn-sm btn-light" href="/thesis/admin/survey?id=<?php echo $survey[0]; ?>">View</a>
                    <a role="button" class="btn btn-sm btn-light">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>