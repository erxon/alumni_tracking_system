<?php

require "/xampp/htdocs/thesis/models/Database.php";
require "/xampp/htdocs/thesis/models/Fields.php";

$field = new Fields();

function validateForm($field, $type, $formType)
{
    if (empty($field) || empty($type) || empty($formType)) {
        echo json_encode(["response" => false, "message" => "Please fill necessary fields"]);
        die();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] == "create-field") {
            validateForm($_POST["field_name"], $_POST["type"], $_POST["form_type"]);
            $result = $field->addField($_POST["field_name"], $_POST["type"], $_POST["form_type"]);

            if ($result) {
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "failed"]);
            }
        }

        if ($_POST["action"] == "edit-field") {
            validateForm($_POST["field"], $_POST["type"], $_POST["formType"]);

            $result = $field->editField($_POST["id"], $_POST["field"], $_POST["type"], $_POST["formType"]);

            if ($result){
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "Something went wrong"]);
            }
        }

        if ($_POST["action"] == "delete-field"){
            $result = $field->deleteField($_POST["id"]);

            if ($result){
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "Something went wrong"]);
            }
        }

        if($_POST["action"] == "add-option"){
            $result = $field->addChoice($_POST["fieldId"], $_POST["choiceName"]);

            if ($result){
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "Something went wrong"]);
            }
        }   

        if($_POST["action"] == "load-choices"){
            $result = $field->getChoices($_POST["fieldId"]);

            if ($result->num_rows > 0){
                echo json_encode(["response" => true, "choices" => $result->fetch_all()]);
            } else {
                echo json_encode(["response" => false, "choices" => 0]);
            }
        }
        if($_POST["action"] == "edit-choice"){
            $result = $field->editChoice($_POST["id"], $_POST["choiceName"]);

            if ($result){
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "Something went wrong"]);
            }
        }

        if ($_POST["action"] == "delete-choice"){
            $result = $field->deleteChoice($_POST["id"]);
            
            if ($result){
                echo json_encode(["response" => true, "message" => "success"]);
            } else {
                echo json_encode(["response" => false, "message" => "Something went wrong"]);
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        //get the field details
        $result = $field->getFieldByID($_GET["id"]);
        //return the result
        if ($result->num_rows > 0) {
            echo json_encode(["response" => true, "field" => $result->fetch_assoc()]);
        } else {
            echo json_encode(["response" => false]);
        }
    } else {
        $result = $field->getFields();

        if ($result->num_rows > 0) {
            echo json_encode(["response" => true, "fields" => $result->fetch_all()]);
        } else {
            echo json_encode(["response" => false]);
        }
    }


}
