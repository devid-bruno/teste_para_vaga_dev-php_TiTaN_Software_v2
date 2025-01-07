<?php
class Empresa {
    private $conn;
    private $table_name = "tbl_empresa";

    public $id_empresa;
    public $nome;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function insert() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome";
        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $stmt->bindParam(":nome", $this->nome);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_empresa=:id_empresa";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_empresa", $this->id_empresa);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome WHERE id_empresa=:id_empresa";
        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->id_empresa = htmlspecialchars(strip_tags($this->id_empresa));
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":id_empresa", $this->id_empresa);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_empresa=:id_empresa";
        $stmt = $this->conn->prepare($query);
        $this->id_empresa = htmlspecialchars(strip_tags($this->id_empresa));
        $stmt->bindParam(":id_empresa", $this->id_empresa);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>