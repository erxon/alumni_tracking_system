<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");
?>

<?php
$content = new Contents();
$news = $content->getNews();
$stringUtil = new StringUltilities();
?>
<div class="d-flex">
    <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
    <div class="main-body-padding admin-views">
        <?php include("/xampp/htdocs/thesis/views/contents/contents_nav.php"); ?>
        <div class="row mt-4">
            <?php
            foreach ($news as $item) {

            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $item[3]; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item[0]; ?></h5>
                            <p class="card-subtitle text-secondary mb-3"><?php
                                                                            $dateCreated = $stringUtil->dateAndTime($item[5]);
                                                                            echo $dateCreated;
                                                                            ?></p>
                            <p class="text-secondary"><?php echo $stringUtil->truncate($item[6]); ?></p>
                            <p class="label mb-0">Author</p>
                            <p class="card-text"><?php
                                                    $author = $content->getAuthor($item[2]);
                                                    echo $author["firstName"] . " " . $author["lastName"];
                                                    ?></p>


                        </div>
                        <div class="card-footer"><a href="/thesis/contents/news?id=<?php echo $item[4]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>