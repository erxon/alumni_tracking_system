<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
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

<div class="main-body-padding">
    <h5><?php echo $galleryDetails["name"]; ?></h5>
    <p>Created on: <?php echo $stringUtil->dateAndTime($galleryDetails["dateCreated"]); ?></p>

    <div class="bg-white rounded p-3">
        <h3>Images</h3>


        <?php if (isset($galleryImages)) { ?>
            <div class="row">
                <?php foreach ($galleryImages as $image) { ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="card">
                            <img class="card-img-top" style="height: 200px; object-fit: cover;" src="/thesis/public/images/gallery/<?php echo $image[1]; ?>" />
                            <div class="card-body">
                                <p class="card-text"><?php echo $image[1] ?></p>
                                <p class="card-text text-secondary">Uploaded on: <?php echo $stringUtil->dateAndTime($image[3]); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>