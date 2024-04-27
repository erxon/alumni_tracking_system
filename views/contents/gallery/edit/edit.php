<?php
session_start();

$id;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}


if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Gallery.php");

$gallery = new Gallery();

$galleryToEdit = $gallery->galleryById($id);

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="container-fluid w-50 m-auto bg-white rounded shadow p-3 mt-5">
        <?php if (isset($id)) { ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all?page=1">Galleries</a></li>
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery?id=<?php echo $id; ?>">Details</a></li>
                    <li class="breadcrumb-item" aria-current="page">Add gallery or image</li>
                </ol>
            </nav>
        <?php } else { ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all?page=1">Galleries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add gallery or image</li>
                </ol>
            </nav>
        <?php } ?>
        <h3>Gallery</h3>

        <hr />
        <form id="edit-gallery">
            <div class="form-floating my-3">
                <input id="gallery-name" name="gallery_name" type="text" class="form-control me-2 flex-fill gallery-field" value="<?php echo $galleryToEdit["name"] ?>" placeholder="Name" />
                <label for="gallery-name">Name</label>
            </div>
            <label for="gallery-description">Description</label>
            <textarea id="gallery-description" name="gallery_description" type="text" class="form-control gallery-field" placeholder="Description" style="resize: none;"><?php echo $galleryToEdit["description"] ?></textarea>
            <div class="mt-3">
                <input hidden id="gallery-id" value="<?php echo $id; ?>" />
                <button disabled type="submit" id="save-changes" class="btn btn-sm btn-dark">Save</button>
                <a role="button" href="/thesis/contents/gallery/all" class="btn btn-sm btn-outline-dark">Cancel</a>
            </div>
        </form>
    </div>

</div>
<?php
include "script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>