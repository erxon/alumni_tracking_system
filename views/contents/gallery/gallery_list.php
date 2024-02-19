<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Gallery.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");
?>
<?php
$gallery = new Gallery();
$allGallery = $gallery->allGallery();
$stringUtil = new StringUltilities();
?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <div class="d-flex">
        <?php include("/xampp/htdocs/thesis/views/template/admin.php"); ?>
        <div class="main-body-padding admin-views">
            <?php
            include("/xampp/htdocs/thesis/views/contents/contents_nav.php");
            ?>
            <div class="row mt-4">
                <?php foreach ($allGallery as $galleryItem) { ?>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="far fa-folder"></i> <?php echo $galleryItem[1] ?></h5>
                                <p style="font-size: 14px" class="card-text"><i class="far fa-clock"></i> <?php echo $stringUtil->dateAndTime($galleryItem[3]) ?></p>
                                <p class="card-text text-secondary"><?php echo $galleryItem[2] ?></p>
                                <a href="/thesis/contents/gallery?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-light">Open Gallery</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding" style="margin-top: 48px">
        <h3>Gallery</h3>
        <div class="row mt-4">
            <?php foreach ($allGallery as $galleryItem) { ?>
                <div class="col-sm-6 col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="far fa-folder"></i> <?php echo $galleryItem[1] ?></h5>
                            <p style="font-size: 14px" class="card-text"><i class="far fa-clock"></i> <?php echo $stringUtil->dateAndTime($galleryItem[3]) ?></p>
                            <p class="card-text text-secondary"><?php echo $galleryItem[2] ?></p>
                            <a href="/thesis/contents/gallery?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-light">Open Gallery</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
<?php } ?>
<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>