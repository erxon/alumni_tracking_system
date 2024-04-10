<?php
session_start();

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$news = $content->getNews();
$stringUtil = new StringUltilities();
?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";

?>
<?php if ($_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a role="button" class="btn btn-sm btn-dark mb-2" href="/thesis/contents/news"><i class="far fa-newspaper me-2"></i>News</a>
        <div class="row g-2">
            <?php
            foreach ($news as $item) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $item[3]; ?>" class="card-img-top">
                        <div class="card-body" style="height: 180px">
                            <h5 class="card-title"><?php echo $item[0]; ?></h5>
                            <div>
                                <p style="font-size: 14px" class="card-subtitle mb-3"><?php
                                                                                        $dateCreated = $stringUtil->dateAndTime($item[5]);
                                                                                        echo $dateCreated;
                                                                                        ?></p>
                                <p class="fw-light"><?php echo $stringUtil->truncate($item[6], 70); ?></p>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/news?id=<?php echo $item[4]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding surveys" style="margin-top: 5%">
        <h1 class="mb-3">News</h1>
        <div class="row g-1">
            <?php
            foreach ($news as $item) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $item[3]; ?>" class="card-img-top">
                        <div class="card-body" style="height: 180px">
                            <h5 class="card-title"><?php echo $item[0]; ?></h5>
                            <div>
                                <p style="font-size: 14px" class="card-subtitle mb-3"><?php
                                                                                        $dateCreated = $stringUtil->dateAndTime($item[5]);
                                                                                        echo $dateCreated;
                                                                                        ?></p>
                                <p class="fw-light"><?php echo $stringUtil->truncate($item[6], 70); ?></p>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/news?id=<?php echo $item[4]; ?>" class="btn btn-sm btn-dark">Read</a></div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
<?php } ?>
<?php
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>