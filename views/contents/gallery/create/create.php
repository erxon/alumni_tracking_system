<?php
session_start();

$id;
if (isset($_GET["galleryId"])) {
    $id = $_GET["galleryId"];
}


if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Gallery.php");

$gallery = new Gallery();

if (isset($_POST["new_gallery"])) {
    $result = $gallery->createGallery($_POST["new_gallery"], $_POST["gallery_description"]);

    if ($result) {
        header("Location: /thesis/contents/gallery/all?page=1");
    }
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding content-form">
    <div class="container-fluid w-75 m-auto bg-white rounded shadow p-3 mt-5">
        <?php if (isset($id)) { ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all">Galleries</a></li>
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery?id=<?php echo $id; ?>">Details</a></li>
                    <li class="breadcrumb-item" aria-current="page">Add gallery or image</li>
                </ol>
            </nav>
        <?php } else { ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all?page=1">Galleries</a></li>
                    <li class="breadcrumb-item" aria-current="page">Add gallery or image</li>
                </ol>
            </nav>
        <?php } ?>
        <h3>Gallery</h3>
        <form method="post">
            <div class="d-flex my-3">
                <input id="new-gallery" name="new_gallery" type="text" class="form-control me-2 flex-fill" placeholder="Create a new gallery" />
            </div>
            <textarea name="gallery_description" type="text" class="form-control" placeholder="Description" style="resize: none;"></textarea>
            <div class="mt-3">
                <button disabled id="add-gallery-button" class="btn btn-sm btn-dark">Add</button>
                <a role="button" href="/thesis/contents/gallery/all" class="btn btn-sm btn-outline-dark">Cancel</a>
            </div>
        </form>

    </div>
</div>

<?php
include "script.php";
include("/xampp/htdocs/thesis/views/template/footer.php")
?>