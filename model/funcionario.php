<?php

class Funcionario {
    private $conn;
    private $table_name = "tbl_funcionario";

    public $id_funcionario;
    public $nome;
    public $cpf;
    public $rg;
    public $email;
    public $id_empresa;
    public $data_cadastro;
    public $salario;
    public $bonificacao;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT f.*, e.nome AS nome_empresa
                  FROM " . $this->table_name . " f
                  LEFT JOIN tbl_empresa e ON f.id_empresa = e.id_empresa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function insert(){
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, cpf=:cpf, rg=:rg, email=:email, data_cadastro=:data_cadastro, salario=:salario, bonificacao=:bonificacao, id_empresa=:id_empresa";

        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->rg = htmlspecialchars(strip_tags($this->rg));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->data_cadastro = htmlspecialchars(strip_tags($this->data_cadastro));
        $this->salario = htmlspecialchars(strip_tags($this->salario));
        $this->bonificacao = htmlspecialchars(strip_tags($this->bonificacao));
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":rg", $this->rg);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":data_cadastro", $this->data_cadastro);
        $stmt->bindParam(":salario", $this->salario);
        $stmt->bindParam(":bonificacao", $this->bonificacao);
        $stmt->bindParam(":id_empresa", $this->id_empresa);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_funcionario = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_funcionario);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome, cpf=:cpf, rg=:rg, email=:email, data_cadastro=:data_cadastro, salario=:salario, bonificacao=:bonificacao, id_empresa=:id_empresa WHERE id_funcionario=:id_funcionario";

        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->rg = htmlspecialchars(strip_tags($this->rg));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->data_cadastro = htmlspecialchars(strip_tags($this->data_cadastro));
        $this->salario = htmlspecialchars(strip_tags($this->salario));
        $this->bonificacao = htmlspecialchars(strip_tags($this->bonificacao));
        $this->id_empresa = htmlspecialchars(strip_tags($this->id_empresa));
        $this->id_funcionario = htmlspecialchars(strip_tags($this->id_funcionario));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":rg", $this->rg);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":data_cadastro", $this->data_cadastro);
        $stmt->bindParam(":salario", $this->salario);
        $stmt->bindParam(":bonificacao", $this->bonificacao);
        $stmt->bindParam(":id_empresa", $this->id_empresa);
        $stmt->bindParam(":id_funcionario", $this->id_funcionario);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id_funcionario = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_funcionario = htmlspecialchars(strip_tags($this->id_funcionario));
        $stmt->bindParam(1, $this->id_funcionario);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>