<?php

include("Database.php");
class Gallery
{
    public function createGallery($galleryName, $description)
    {
        $db = new Database();
        $query = "INSERT INTO gallery (name, description) VALUES ('$galleryName', '$description')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function allGallery()
    {
        $db = new Database();
        $query = "SELECT * FROM gallery";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function addImageToGallery($galleryId, $image)
    {
        $db = new Database();
        $query = "INSERT INTO gallery_image (galleryId, image) VALUES ($galleryId, '$image')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function galleryById($id)
    {
        $db = new Database();
        $query = "SELECT * FROM gallery WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_assoc();
    }

    public function galleryImages($galleryId)
    {
        $db = new Database();
        $query = "SELECT * FROM gallery_image WHERE galleryId=$galleryId";

        $result = $db->query($query);

        $db->close();
        
        if ($result->num_rows > 0) {
            return $result->fetch_all();
        } else {
            return false;
        }
    }

    public function deleteImage($imageId){
        $db = new Database();
        $query = "DELETE FROM gallery_image WHERE id=$imageId";

        $result = $db->query($query);
        $db->close();

        return $result;
    }
}
