<?php 

require "Database.php";
class Fields {


    public function getCurrentFields(){
        $db = new Database();

        $query = "SELECT * FROM alumni";
        $result = $db->query($query);

        return $result->fetch_fields();
    }

    public function addField($fieldName, $type, $formType) {
        $db = new Database();

        $query = "INSERT INTO field (field, type, formType) VALUES ('$fieldName', '$type', '$formType')";
        $result = $db->query($query);

        return $result;
    }

    public function getFields(){
        $db = new Database();

        $query = "SELECT * FROM field ORDER BY dateCreated DESC";
        $result = $db->query($query);

        return $result;
    }

    public function getFieldByID($fieldID){
        $db = new Database();

        $query = "SELECT * FROM field WHERE id=$fieldID";
        $result = $db->query($query);

        return $result;
    }

    public function deleteField($fieldID){
        $db = new Database();

        $query = "DELETE FROM field WHERE id=$fieldID";
        $result = $db->query($query);

        return $result;
    }

    public function editField($fieldID, $fieldName, $type, $formType){
        $db = new Database();

        $query = "UPDATE field SET field='$fieldName', 
        type='$type', 
        formType='$formType' WHERE id='$fieldID'";

        $result = $db->query($query);

        return $result;
    }

    //Choices

    public function addChoice($fieldId, $choiceName){
        $db = new Database();

        $query = "INSERT INTO choice (fieldID, choiceName) VALUES ($fieldId, '$choiceName')";
        $result = $db->query($query);

        return $result;
    }

    public function getChoices($fieldID){
        $db = new Database();

        $query = "SELECT * FROM choice WHERE fieldID=$fieldID";
        $result = $db->query($query);

        return $result;
    }

    public function editChoice($id, $choiceName){
        $db = new Database();

        $query = "UPDATE choice SET choiceName='$choiceName' WHERE id=$id";

        $result = $db->query($query);

        return $result;
    }

    public function deleteChoice($id){
        $db = new Database();

        $query = "DELETE FROM choice WHERE id=$id";

        $result = $db->query($query);

        return $result;
    }

    //Answers

    public function addAnswer($fieldID, $alumniID, $answer){

    }

    public function getAnswers(){

    }

    public function getAnswersByAlumni($alumnID){

    }

    public function getAnswersByFieldID($fieldID){

    }

    public function getAnswerByID($id){

    }

    public function deleteAnswer($id){

    }

    public function editAnswer($id){
        
    }

}