<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$surveys = $content->getSurveys();
$stringUtil = new StringUltilities();
?>
<div class="d-flex">
    <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    <div class="main-body-padding admin-views">
        <?php include("/xampp/htdocs/thesis/views/contents/contents_nav.php"); ?>
        <div class="row mb-4">
            <?php foreach ($surveys as $survey) { ?>
                <div class="card m-2 col-md-4 p-0" style="width: 16rem;">
                    <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey[1]; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $survey[2]; ?></h5>
                        <p class="card-subtitle text-secondary mb-3"><?php
                                                                        $dateCreated = $stringUtil->dateAndTime($survey[5]);
                                                                        echo $dateCreated;
                                                                        ?></p>
                        <p class="label mb-0">Author</p>
                        <p class="card-text"><?php
                                                $author = $content->getAuthor($survey[4]);
                                                echo $author["firstName"] . " " . $author["lastName"];
                                                ?></p>

                    </div>
                    <div class="card-footer"><a href="/thesis/contents/surveys?id=<?php echo $survey[0]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>