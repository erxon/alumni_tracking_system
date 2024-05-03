<?php

class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'alumni_tracking';
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function multi_query($sql){
        return $this->conn->multi_query($sql);
    }

    public function getId(){
        return $this->conn->insert_id;
    }

    public function error(){
        return $this->conn->error;
    }

    public function next_result(){
        return $this->conn->next_result();
    }

    public function close()
    {
        $this->conn->close();
    }
}

?>
