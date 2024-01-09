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

    public function getId(){
        return $this->conn->insert_id;
    }

    public function close()
    {
        $this->conn->close();
    }
}

?>
