<?php
require("/xampp/htdocs/thesis/models/Database.php");


class AlumniUtility
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
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

    protected function validatePassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    protected function displayError($e)
    {
        $error = $e->getMessage();
        echo $error;
    }
}
