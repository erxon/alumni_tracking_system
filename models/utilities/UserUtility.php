<?php

class UserUtility
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function checkResult($result)
    {
        if ($result->num_rows == 0) {
            throw new Exception("No results");
        }
        return;
    }

    protected function validatePassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    protected function verifyPassword($hash_password, $password)
    {
        if (!password_verify($hash_password, $password)) {
            throw new Exception("Password incorrect");
        }
        return;
    }

    protected function checkIfEmpty($username, $first_name, $last_name, $email, $type, $password)
    {
        if (
            $username == "" or
            $first_name == "" or
            $last_name == "" or
            $email == "" or
            $type == "" or
            $password == ""
        ) {
            throw new Exception("Empty fields");
        }
        return;
    }

    protected function editUserCheckFields($username, $first_name, $last_name, $email)
    {
        if (
            $username == "" ||
            $first_name == "" ||
            $last_name == "" ||
            $email == ""
        ) {
            throw new Exception("Invalid fields");
        }
        return;
    }

    protected function usernameExists($username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            throw new Exception("Username already exists");
        }
        return;
    }

    protected function editUserCheckUsername($username, $userId)
    {
        $sql = "SELECT username FROM user WHERE id='$userId'";
        $result = $this->db->query($sql);

        $rows = $result->fetch_assoc();
        if ($rows["username"] != $username) {
            try {
                $this->usernameExists($username);
                return;
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo "<p class='error'>$error</p>";
            }
        } else {
            return;
        }
    }

    protected function updateSession($changes)
    {
        $_SESSION["username"] = $changes["username"];
        $_SESSION["first_name"] = $changes["first_name"];
        $_SESSION["last_name"] = $changes["last_name"];
        $_SESSION["email"] = $changes["email"];
    }

    protected function displayError($e)
    {
        $error = $e->getMessage();
        echo $error;
    }
}
