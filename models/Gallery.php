<?php

include("Database.php");
class Gallery
{
    public function createGallery($galleryName)
    {
        $db = new Database();
        $query = "INSERT INTO gallery (name) VALUES ('$galleryName')";

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

    public function galleryImages($galleryId){
        $db = new Database();
        $query = "SELECT * FROM gallery_image WHERE galleryId=$galleryId";

        $result = $db->query($query);

        $db->close();

        return $result->fetch_all();
    }
}
