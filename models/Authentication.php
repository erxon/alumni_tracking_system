<?php

require("Database.php");

class Authentication
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            throw new Exception("Please type your username and password");
            die();
        }
        //Query database for existing username
        $sql = "SELECT * FROM user WHERE username = '$username'";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["first_name"] = $row["firstName"];
                $_SESSION["last_name"] = $row["lastName"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["type"] = $row["type"];

                header("Location: /thesis/home");
            } else {
                throw new Exception("Password is incorrect");
                die();
            }
        } else {
            throw new Exception("Username do not exist");
            die();
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /thesis/login");
    }
}
