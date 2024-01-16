<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Gallery.php");

$gallery = new Gallery();

if (isset($_POST["new_gallery"])) {
    $result = $gallery->createGallery($_POST["new_gallery"]);

    if ($result) {
        header("Location: /thesis/contents/gallery");
    }
}

$allGallery = $gallery->allGallery();

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding content-form">
    <h3>Gallery</h3>
    <select id="gallery-selection" class="form-select" aria-label="Default select example">
        <option selected value="">Select a gallery to add an image</option>
        <?php
        if (isset($allGallery)) {
            foreach ($allGallery as $galleryItem) {
        ?>
                <option value="<?php echo $galleryItem[0]; ?>"><?php echo $galleryItem[1]; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
    <form method="post">
        <div class="d-flex mt-3">
            <input id="new-gallery" name="new_gallery" type="text" class="form-control me-2 flex-fill" placeholder="Create a new gallery" />
            <button disabled id="add-gallery-button" class="btn btn-sm btn-dark">Add</button>
        </div>
    </form>

    <div id="upload-photo-container" class="bg-white p-3 rounded mt-3" style="display: none">
        <p>Please select an image to add to your gallery</p>
        <form id="upload-image-gallery" enctype="multipart/form-data">
            <div class="d-flex">
                <input name="gallery_image" type="file" class="form-control me-2" />
                <button type="submit" class="btn btn-sm btn-dark">Upload</button>
            </div>
        </form>
    </div>

</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>