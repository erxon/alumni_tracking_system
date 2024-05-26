<?php 
class SchoolInformation{

    public function getTracks(){
        $db = new Database();

        $query = "SELECT * FROM tracks";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getStrands(){
        $db = new Database();

        $query = "SELECT * FROM strands";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getSpecializations(){
        $db = new Database();

        $query = "SELECT * FROM specializations";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getBatches(){
        $db = new Database();

        $query = "SELECT yearGraduated FROM alumni_school_history";

        $result = $db->query($query);

        return $result->fetch_all();
    }
}