<?php

include("/xampp/htdocs/thesis/models/Gallery.php");
$str = rand();
$uniqueFilename = md5($str);
$gallery = new Gallery();

if (isset($_FILES) && count($_FILES) > 0) {
    $tempname = $_FILES["gallery_image"]["tmp_name"];
    $target_file = "./public/images/gallery/" . basename($_FILES["gallery_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $galleryImage = $uniqueFilename . '.' . $imageFileType;
    $folder = "./public/images/gallery/" . $galleryImage;

    move_uploaded_file($tempname, $folder);

    $result = $gallery->addImageToGallery($_POST["gallery_id"], $galleryImage);

    echo json_encode(array("response" => "File uploaded"));
} else {
    echo json_encode(array("response" => "Please add an image file"));
}
