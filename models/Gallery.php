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
        $query = "SELECT * FROM gallery ORDER BY dateCreated DESC";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function getSortedGallery($sort)
    {
        $db = new Database();
        $query = "";

        if ($sort == "DESC") {
            $query = "SELECT * FROM gallery ORDER BY dateCreated DESC";
        } else if ($sort == "ASC") {
            $query = "SELECT * FROM gallery ORDER BY dateCreated ASC";
        }
        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }
    public function getGalleryByName($name)
    {
        $db = new Database();
        $query = "SELECT * FROM gallery WHERE name='$name'";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }
    public function addImageToGallery($galleryId, $image)
    {
        $db = new Database();
        $query = "INSERT INTO gallery_image (galleryId, image) VALUES ($galleryId, '$image')";

        $result = $db->query($query);
        $id = $db->getId();
        $db->close();

        return $id;
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

    protected function deleteImageFile($imageName)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/thesis/public/images/gallery/$imageName";
        unlink($path);
    }

    public function deleteImage($imageId, $imageName)
    {
        $db = new Database();
        $query = "DELETE FROM gallery_image WHERE id=$imageId";

        $this->deleteImageFile($imageName);

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    protected function deleteImages($galleryId, $db)
    {
        $getImages = "SELECT image FROM gallery_image WHERE galleryId=$galleryId";
        $images = $db->query($getImages);

        if ($images->num_rows > 0) {
            foreach ($images->fetch_all() as $image) {
                $imageToRemove = $image[0];
                unlink("/xampp/htdocs/thesis/public/images/gallery/$imageToRemove");
            }
        }

        $deleteImages = "DELETE FROM gallery_image WHERE galleryId=$galleryId";
        $result = $db->query($deleteImages);

        if (!$result) {
            throw new Exception(false);
        }
    }

    public function deleteGallery($id)
    {
        $db = new Database();

        try {
            $this->deleteImages($id, $db);
            $query = "DELETE FROM gallery WHERE id=$id;";

            $result = $db->query($query);
            $db->close();

            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateGallery($id, $name, $description)
    {
        $db = new Database();

        $query = "UPDATE gallery SET name='$name', description='$description' WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result;
    }
}
