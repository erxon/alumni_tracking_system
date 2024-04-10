<?php

include "/xampp/htdocs/thesis/models/Gallery.php";
$gallery = new Gallery();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $id = $_POST["id"];
    if ($action == "delete") {
        $result = $gallery->deleteGallery($id);

        if ($result) {
            echo json_encode(["response" => "success", "result" => $result]);
        } else {
            echo json_encode(["response" => "failed", "result" => $result]);
        }
    }

    if ($action == "edit") {
        $name = $_POST["gallery_name"];
        $description = $_POST["gallery_description"];

        $result = $gallery->updateGallery($id, $name, $description);

        if ($result) {
            echo json_encode(["response" => "success", "result" => $result]);
        } else {
            echo json_encode(["response" => "failed", "result" => $result]);
        }
    }

    if ($action == "delete-image") {
        $imageId = $_POST["id"];
        $imageName = $_POST["imageName"];

        $result = $gallery->deleteImage($imageId, $imageName);

        if ($result) {
            echo json_encode(["response" => "success", "result" => $result]);
        } else {
            echo json_encode(["response" => "failed", "result" => $result]);
        }
    }

    if ($action == "upload-image") {
        $str = rand();
        $uniqueFilename = md5($str);

        if ($_FILES["gallery_image"]["name"]) {
            $tempname = $_FILES["gallery_image"]["tmp_name"];
            $target_file = "./public/images/gallery/" . basename($_FILES["gallery_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $galleryImage = $uniqueFilename . '.' . $imageFileType;
            $folder = "./public/images/gallery/" . $galleryImage;

            move_uploaded_file($tempname, $folder);

            $result = $gallery->addImageToGallery($_POST["gallery_id"], $galleryImage);

            echo json_encode(["response" => "File uploaded", "image" => $galleryImage, "id" => $result]);
        } else {
            echo json_encode(["response" => "Please add an image file"]);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $galleries = $gallery->allGallery();
    echo json_encode(["response" => $galleries]);
}
