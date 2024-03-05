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

//Delete image
if (isset($_POST["delete-action"])) {
    $imageName = $_POST["image_name"];
    $path = $_SERVER['DOCUMENT_ROOT'] . "/thesis/public/images/gallery/$imageName";

    unlink($path);
    $gallery->deleteImage($_POST["delete-action"]);

    header("Location: /thesis/contents/gallery?id=$id");
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/thesis/contents/gallery/all">Galleries</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $galleryDetails["name"]; ?></li>
        </ol>
    </nav>
    <h5><?php echo $galleryDetails["name"]; ?></h5>
    <p>Created on: <?php echo $stringUtil->dateAndTime($galleryDetails["dateCreated"]); ?></p>

    <div class="bg-white rounded p-3">
        <h3>Images</h3>
        <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
            <a role="button" class="btn btn-sm btn-dark my-3" href="/thesis/contents/gallery/imageupload?galleryId=<?php echo $galleryDetails["id"]; ?>">Upload images</a>
        <?php } ?>
        <?php if ($galleryImages) { ?>
            <div class="row">
                <?php foreach ($galleryImages as $image) { ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="card mb-2">
                            <img class="card-img-top" style="height: 300px; object-fit: contain;" src="/thesis/public/images/gallery/<?php echo $image[1]; ?>" />
                            <div class="card-body">
                                <p class="card-text"><?php echo $image[1] ?></p>
                                <p class="card-text text-secondary">Uploaded on: <?php echo $stringUtil->dateAndTime($image[3]); ?></p>
                            </div>
                            <?php if ($_SESSION["type"] == "admin") { ?>
                                <div class="card-footer">
                                    <form method="post">
                                        <input hidden name="image_name" value="<?php echo $image[1] ?>" />
                                        <button name="delete-action" value="<?php echo $image[0] ?>" class="btn btn-sm btn-light"><i class="fas fa-trash"></i></button>
                                    </form>
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

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>