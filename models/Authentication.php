<?php

require("Database.php");

class Authentication
{
    public function login($username, $password)
    {
        $db = new Database();
        if (empty($username) || empty($password)) {
            throw new Exception("Please type your username and password");

        }
        //Query database for existing username
        $sql = "SELECT * FROM user WHERE username = '$username'";

        $result = $db->query($sql);

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
            }
        } else {
            throw new Exception("Username do not exist");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /thesis/login");
    }
}
