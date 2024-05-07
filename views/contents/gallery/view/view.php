<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Gallery.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$id = $_GET["id"];
$gallery = new Gallery();
$stringUtil = new StringUltilities();

$galleryDetails = $gallery->galleryById($id);
$galleryImages = $gallery->galleryImages($id);


include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div style="margin-top: 3%;" class="main-body-padding">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all?page=1">Galleries</a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo $galleryDetails["name"]; ?></li>
        </ol>
    </nav>
    <h5><?php echo $galleryDetails["name"]; ?></h5>
    <p>Created on: <?php echo $stringUtil->dateAndTime($galleryDetails["dateCreated"]); ?></p>
    <div class="bg-white rounded p-3">
        <h3>Images</h3>
        <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
            <button data-bs-toggle="modal" data-bs-target="#upload-image-modal" class="btn btn-sm btn-dark my-3">Upload images</button>
        <?php } ?>
        <?php if ($galleryImages) { ?>
            <div id="image-gallery" class="row">
                <?php foreach ($galleryImages as $image) {
                    $imageId = $image[0];
                ?>
                    <div id="image_<?php echo $imageId ?>" class="col-sm-6 col-md-4">
                        <div class="card mb-2">
                            <img onclick="imageFull('<?php echo '/thesis/public/images/gallery/' . $image[1]; ?>')" class="image card-img-top" style="height: 300px; object-fit: cover; cursor: pointer;" src="/thesis/public/images/gallery/<?php echo $image[1]; ?>" />
                            <div class="card-body">
                                <p class="card-text"><?php echo $image[1] ?></p>
                                <p class="card-text text-secondary">Uploaded on: <?php echo $stringUtil->dateAndTime($image[3]); ?></p>
                            </div>
                            <?php if ($_SESSION["type"] == "admin") { ?>
                                <div class="card-footer">
                                    <input hidden name="image_name" value="<?php echo $image[1] ?>" />
                                    <button onclick="deleteImage('<?php echo $image[0] ?>', '<?php echo $image[1] ?>')" data-bs-toggle="modal" data-bs-target="#delete-image-confirmation" class="btn btn-sm btn-light"><i class="fas fa-trash"></i></button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-secondary">No images yet</p>
        <?php } ?>
    </div>
</div>

<div class="modal modal-lg fade" id="image-full" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="image-container"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-image-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this image?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="delete-image" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-image-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="upload-image-gallery" enctype="multipart/form-data">
                <div class="modal-body">
                    <input hidden id="gallery-id" name="gallery_id" value="<?php echo $id; ?>" />
                    <input id="gallery-image" name="gallery_image" type="file" accept="image/jpeg, image/png, image/jpg" class="form-control me-2" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="upload-image" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>