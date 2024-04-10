<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /thesis/");
    return;
}


include("/xampp/htdocs/thesis/models/Gallery.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$gallery = new Gallery();
$allGallery = $gallery->allGallery();
$stringUtil = new StringUltilities();

?>
<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a role="button" class="btn btn-sm btn-dark mb-2" href="/thesis/contents/gallery">
            <i class="far fa-images me-2"></i>Gallery
        </a>
        <div id="galleries-container" class="row g-2">
            <?php foreach ($allGallery as $galleryItem) { ?>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body" style="height: 200px">
                            <h5 class="card-title"><i class="far fa-folder"></i> <?php echo $galleryItem[1] ?></h5>
                            <p style="font-size: 14px" class="card-text"><i class="far fa-clock"></i> <?php echo $stringUtil->dateAndTime($galleryItem[3]) ?></p>
                            <p class="fw-light" style="font-size: 14px; height: 50px;"><?php echo $stringUtil->truncate($galleryItem[2], 50); ?></p>
                            <div class="d-flex">
                                <div class="w-100">
                                    <a role="button" href="/thesis/contents/gallery?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-dark">See images</a>
                                </div>
                                <a role="button" href="/thesis/contents/gallery/edit?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></a>
                                <button onclick="deleteGallery('<?php echo $galleryItem[0]; ?>')" data-bs-toggle="modal" data-bs-target="#delete-gallery-confirmation" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding surveys" style="margin-top: 5%">
        <h1 class="mb-3">Gallery</h1>
        <div class="row mt-4">
            <?php foreach ($allGallery as $galleryItem) { ?>
                <div class="col-sm-6 col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body d-flex flex-column" style="height: 200px">
                            <div class="h-100">
                                <h5 class="card-title"><i class="far fa-folder"></i> <?php echo $galleryItem[1] ?></h5>
                                <p style="font-size: 14px;"><i class="far fa-clock"></i> <?php echo $stringUtil->dateAndTime($galleryItem[3]) ?></p>
                                <p style="font-size: 14px;"><?php echo $galleryItem[2] ?></p>
                            </div>
                            <a href="/thesis/contents/gallery?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-dark d-block">Open Gallery</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
<?php } ?>

<div class="modal fade" id="delete-gallery-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete gallery</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this gallery?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="confirm-delete" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include("/xampp/htdocs/thesis/views/template/footer.php")
?>