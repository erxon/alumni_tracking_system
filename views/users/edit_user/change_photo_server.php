<?php
session_start();

include("/xampp/htdocs/thesis/models/Database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];

    //upload photo to database
    //if the user already have a photo, remove the photo, and upload the new one
    //else upload the new photo

    if ($_FILES["profilePhoto"]["name"]) {
        if (isset($_SESSION["photo"])) {
            $photo = $_SESSION["photo"];
            unlink("/xampp/htdocs/thesis/public/images/profile/$photo");
        }

        $str = rand();
        $uniqueFilename = md5($str);

        $tempname = $_FILES["profilePhoto"]["tmp_name"];
        $target_file = "./public/images/profile/" . basename($_FILES["profilePhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $profilePhoto = $uniqueFilename . '.' . $imageFileType;
        $folder = "./public/images/profile/" . $profilePhoto;

        move_uploaded_file($tempname, $folder);

        $query = "UPDATE user SET photo='$profilePhoto' WHERE id='$user_id'";

        $database = new Database();

        $database->query($query);

        $_SESSION["photo"] = $profilePhoto;

        header("Location: /thesis/users/edit?id=$user_id");

    } else {
        header("Location: /thesis/users/edit?id=$user_id");
    }
}
