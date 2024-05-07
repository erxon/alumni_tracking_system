<?php

require ("Database.php");
require ("/xampp/htdocs/thesis/models/utilities/UserUtility.php");

class Users extends UserUtility
{
    public function createUser($email, $type)
    {
        //Signup code goes here
        try {
            $this->checkIfEmpty($email, $type);

            $sql = "INSERT INTO user (email, type) VALUES ('$email','$type')";

            $result = $this->db->query($sql);

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editUser($user_id, $changes)
    {
        //changes is an associative array containing all the values to change
        $username = $changes["username"];

        try {
            $this->editUserCheckFields($username);
            $this->editUserCheckUsername($username, $user_id);
            //Update Session Variables
            $this->updateSession($changes);

            $sql = "UPDATE user SET 
            username='$username' WHERE id='$user_id'";

            $result = $this->db->query($sql);

            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function changePhoto($id)
    {
        $tempname = $_FILES["profilePhoto"]["tmp_name"];
        $target_file = "./public/images/profile/" . basename($_FILES["profilePhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file = $id . '.' . $imageFileType;
        $folder = "./public/images/profile/" . $id . '.' . $imageFileType;

        $sql = "UPDATE user SET photo='$file' WHERE id=$id";
        $this->db->query($sql);

        return move_uploaded_file($tempname, $folder);
    }

    public function changePassword($current_password, $new_password, $user_id)
    {
        $sql = "SELECT password FROM user WHERE id='$user_id'";
        $result = $this->db->query($sql);
        try {
            $this->checkResult($result);
            $rows = $result->fetch_assoc();

            $this->verifyPassword($current_password, $rows["password"]);
            $hash_new_password = $this->validatePassword($new_password);
            $update_password = "UPDATE user SET password='$hash_new_password' WHERE id='$user_id'";

            $result = $this->db->query($update_password);

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM user WHERE id='$user_id'";

        $result = $this->db->query($sql);

        return $result;
    }

    public function deleteAlumniByUserId($user_id)
    {
        $sql = "DELETE FROM alumni WHERE userAccountID=$user_id";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getUsers($offset)
    {
        $sql = "SELECT user.id, user.username, user.firstName, user.lastName, user.email, user.type
        FROM user LEFT JOIN alumni ON user.id=alumni.userAccountID 
        WHERE alumni.status IS NULL OR alumni.status = 'active' 
        ORDER BY user.dateCreated DESC LIMIT 5 OFFSET $offset";

        $result = $this->db->query($sql);

        try {
            $this->checkResult($result);

            return $result;
        } catch (Exception $e) {
            $this->displayError($e);
        }
    }

    public function getAllUsers(){
        $sql = "SELECT email FROM user";

        $result = $this->db->query($sql);

        return $result->fetch_all();
    }

    public function numberOfUsers(){
        $sql = "SELECT * FROM user";
        $result = $this->db->query($sql);

        return $result->num_rows;
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM user WHERE email='$email'";

        $result = $this->db->query($sql);

        try {

            $this->checkResult($result);
            return $result;
        } catch (Exception $e) {
            $this->displayError($e);
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id='$id'";

        $result = $this->db->query($sql);

        try {
            $this->checkResult($result);
            return $result;
        } catch (Exception $e) {
            $this->displayError($e);
        }

    }

    public function getNumberOfUsers()
    {
        $sql = "SELECT COUNT(*) FROM user";
        $count = $this->db->query($sql);

        return $count->fetch_all();
    }

    public function getAlumniProfile($userId)
    {
        $sql = "SELECT * FROM alumni WHERE userAccountID=$userId";

        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }

    public function getAlumniStatus($userId)
    {
        $sql = "SELECT status FROM alumni WHERE userAccountId=$userId";

        $result = $this->db->query($sql);

        return $result;
    }

    public function checkEmail($email){
        $sql = "SELECT * FROM alumni WHERE email='$email'";

        $result = $this->db->query($sql);

        if($result->num_rows > 0){
            return true;
        } else {
            return false;
        }
    }
}
