<?php
session_start();

include("/xampp/htdocs/thesis/models/Gallery.php");

$id = $_GET["galleryId"];
$gallery = new Gallery();

$galleryToEdit = $gallery->galleryById($id);

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<p>Please select an image to add to your gallery</p>
<div class="main-body-padding">
    <div class="container-fluid w-50 m-auto bg-white rounded shadow p-3 mt-5">
        <form id="upload-image-gallery" enctype="multipart/form-data">
            <div class="d-flex">
                <?php if (isset($id)) { ?>
                    <input hidden name="gallery_id" value="<?php echo $id ?>" />
                <?php } ?>
                <input name="gallery_image" type="file" class="form-control me-2" />
                <button type="submit" class="btn btn-sm btn-dark">Upload</button>
            </div>
        </form>
    </div>
</div>
<?php include("/xampp/htdocs/thesis/views/template/footer.php"); ?>