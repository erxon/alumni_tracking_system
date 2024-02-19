<?php

require("Database.php");
require("/xampp/htdocs/thesis/models/utilities/UserUtility.php");

class Users extends UserUtility
{
    public function createUser($username, $first_name, $last_name, $email, $type, $password)
    {
        //Signup code goes here
        try {
            $this->checkIfEmpty($username, $first_name, $last_name, $email, $type, $password);
            $this->usernameExists($username);

            $hash = $this->validatePassword($password);
            $sql = "INSERT INTO user (username, firstName, lastName, email, password, type) VALUES ('$username', '$first_name', '$last_name', '$email', '$hash', '$type')";

            $this->db->query($sql);
        } catch (Exception $e) {
            $this->displayError($e);
            die();
        }
    }

    public function editUser($user_id, $changes)
    {
        //changes is an associative array containing all the values to change
        $username = $changes["username"];
        $first_name = $changes["first_name"];
        $last_name = $changes["last_name"];
        $email = $changes["email"];
        $date_modified = date("Y-m-d");

        try {
            $this->editUserCheckFields($username, $first_name, $last_name, $email);
            $this->editUserCheckUsername($username, $user_id);
            //Update Session Variables
            $this->updateSession($changes);

            $sql = "UPDATE user SET 
            username='$username', 
            firstName='$first_name', 
            lastName='$last_name', 
            email='$email',
            dateModified='$date_modified' WHERE id='$user_id'";

            $result = $this->db->query($sql);

            return $result;
        } catch (Exception $e) {
            $error = array("response" => $e->getMessage());
            echo json_encode($error);
        }
    }

    public function changePhoto(){
        
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
            $error = array("response" => $e->getMessage());
            echo json_encode($error);
        }
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM user WHERE id='$user_id'";

        $this->db->query($sql);
        session_destroy();
    }

    public function getUsers()
    {
        $sql = "SELECT id, username, firstName, lastName, email, type FROM user";

        $result = $this->db->query($sql);

        try {
            $this->checkResult($result);

            return $result;
        } catch (Exception $e) {
            $this->displayError($e);
        }
    }

    public function getUser($id)
    {
        $sql = "SELECT id, photo, username, firstName, lastName, email, type FROM user WHERE id='$id'";

        $result = $this->db->query($sql);

        try {
            
            $this->checkResult($result);
            return $result;

        } catch (Exception $e) {
            $this->displayError($e);
        }
    }
}
