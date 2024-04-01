<?php
session_start();

$id;
if (isset ($_GET["galleryId"])) {
    $id = $_GET["galleryId"];
}


if (!isset ($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include ("/xampp/htdocs/thesis/models/Gallery.php");

$gallery = new Gallery();

if (isset ($_POST["new_gallery"])) {
    $result = $gallery->createGallery($_POST["new_gallery"], $_POST["gallery_description"]);

    if ($result) {
        header("Location: /thesis/contents/gallery");
    }
}

$allGallery = $gallery->allGallery();

include ("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding content-form">
    <?php if (isset ($id)) { ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all">Galleries</a></li>
                <li class="breadcrumb-item"><a href="/thesis/contents/gallery?id=<?php echo $id; ?>">Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add gallery or image</li>
            </ol>
        </nav>
    <?php } else { ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all">Galleries</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add gallery or image</li>
            </ol>
        </nav>
    <?php } ?>
    <h3>Gallery</h3>

    <h5>Upload image to gallery</h5>
    <select id="gallery-selection" class="form-select mb-3" aria-label="Default select example">
        <option value="">Select a gallery to add an image</option>
        <?php
        if (isset ($allGallery)) {
            foreach ($allGallery as $galleryItem) {
                ?>
                <?php if (isset ($id)) { ?>
                    <option <?php if ($id == $galleryItem[0]) {
                        echo "selected";
                    } ?> value="<?php echo $galleryItem[0]; ?>">
                        <?php echo $galleryItem[1]; ?>
                    </option>
                <?php } else { ?>
                    <option value="<?php echo $galleryItem[0]; ?>">
                        <?php echo $galleryItem[1]; ?>
                    </option>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </select>
    <div id="upload-photo-container" class="bg-white p-3 rounded mt-3" style="<?php if (empty ($id)) {
        echo "display: none";
    } ?>">
        <p>Please select an image to add to your gallery</p>
        <form id="upload-image-gallery" enctype="multipart/form-data">
            <div class="d-flex">
                <?php if (isset ($id)) { ?>
                    <input hidden name="gallery_id" value="<?php echo $id ?>" />
                <?php } ?>
                <input name="gallery_image" type="file" class="form-control me-2" />
                <button type="submit" class="btn btn-sm btn-dark">Upload</button>
            </div>
        </form>
    </div>
    <hr />
    <form method="post">
        <div class="d-flex my-3">
            <input id="new-gallery" name="new_gallery" type="text" class="form-control me-2 flex-fill"
                placeholder="Create a new gallery" />
            <button disabled id="add-gallery-button" class="btn btn-sm btn-dark">Add</button>
        </div>
        <textarea name="gallery_description" type="text" class="form-control" placeholder="Description"
            style="resize: none;"></textarea>
    </form>
    
    <a role="button" href="/thesis/contents/gallery/all" class="btn btn-sm btn-outline-dark mt-3">Cancel</a>
</div>

<?php
include ("/xampp/htdocs/thesis/views/template/footer.php")
    ?>