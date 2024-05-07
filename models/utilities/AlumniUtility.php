<?php
require("/xampp/htdocs/thesis/models/Database.php");


class AlumniUtility
{
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
        $db = new Database();
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $db->query($sql);

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

    protected function filterValue($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            return $_POST[$fieldName];
        } else {
            return "";
        }
    }

    protected function withOtherField($field)
    {
        $value = "";

        if ($this->filterValue($field) === "") {
            $value = $this->filterValue("$field-other");
        } else {
            $value = $this->filterValue($field);
        }

        return $value;
    }

    protected function forParentFields(
        $parent,
        $expectedResults
    ) {
        $result = "";

        //["Expected Value"=>"field"]
        foreach ($expectedResults as $key => $value) {
            if ($parent === $key) {
                $result = $this->withOtherField($value);
                break;
            }
        }

        return $result;
    }
}
