<?php
class Database{
    private $host = 'localhost';
    private $db_name = 'project';
    private $db_user = 'root';
    private $db_pass = '123';
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->db_name,
                $this->db_user,
                $this->db_pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            echo 'Connection Error: ' . $e->getMessage();
            die();
        }
        
        return $this->conn;
    }
}

?>