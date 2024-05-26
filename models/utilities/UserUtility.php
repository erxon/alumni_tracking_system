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

    protected function checkIfEmpty($email, $type)
    {
        if (
            $email == "" or
            $type == ""
        ) {
            throw new Exception("Empty fields");
        }
        return;
    }

    protected function editUserCheckFields($username)
    {
        if (
            $username == ""
        ) {
            throw new Exception("Invalid fields");
        }
        return;
    }

    protected function emailExists($email)
    {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            throw new Exception("Email already exists");
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
        if (isset($changes["username"])) {
            $_SESSION["username"] = $changes["username"];
        } else {
            $_SESSION["email"] = $changes["email"];
        }
    }

    protected function displayError($e)
    {
        $error = $e->getMessage();
        echo $error;
    }
}
