<?php
session_start();
include_once '../db.php';
include_once '../model/Funcionario.php';
include_once '../model/Empresa.php';

$database = new Database();
$db = $database->getConnection();

class funcionarioController {
    public function index() {
        if (!isset($_SESSION['login'])) {
            $error = "Por favor, faça login para acessar o sistema.";
            include '../view/index.php';
            exit();
        }

        global $db;
        $funcionario = new Funcionario($db);
        $stmt = $funcionario->read();
        $funcionarios = [];
        if ($stmt) {
            $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        include '../view/home.php';
    }

    public function cadastro() {
        global $db;
        $empresa = new Empresa($db);
        $stmt = $empresa->read();
        $empresas = [];
        if ($stmt) {
            $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        include '../view/funcionario/create.php';
    }

    public function create() {
        global $db;
        $funcionario = new Funcionario($db);
        $funcionario->nome = htmlspecialchars($_POST['nome'] ?? '');
        $funcionario->cpf = htmlspecialchars($_POST['cpf'] ?? '');
        $funcionario->rg = htmlspecialchars($_POST['rg'] ?? '');
        $funcionario->email = htmlspecialchars($_POST['email'] ?? '');
        $funcionario->id_empresa = htmlspecialchars($_POST['id_empresa'] ?? '');

        if ($funcionario->insert()) {
            header('Location: funcionarioController.php?action=index');
            exit();
        } else {
            $error = "Erro ao cadastrar funcionário.";
            include '../view/funcionario/create.php';
        }
    }

    public function edit() {
        global $db;
        $funcionario = new Funcionario($db);
        $funcionario->id_funcionario = htmlspecialchars($_GET['id'] ?? '');
        $stmt = $funcionario->readOne();
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        
        $empresa = new Empresa($db);
        $stmt = $empresa->read();
        $empresas = [];
        if ($stmt) {
            $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        include '../view/funcionario/edit.php';
    }

    public function update(){
        global $db;
        $funcionario = new Funcionario($db);
        $funcionario->id_funcionario = htmlspecialchars($_GET['id'] ?? '');
        $funcionario->nome = htmlspecialchars($_POST['nome'] ?? '');
        $funcionario->cpf = htmlspecialchars($_POST['cpf'] ?? '');
        $funcionario->rg = htmlspecialchars($_POST['rg'] ?? '');
        $funcionario->email = htmlspecialchars($_POST['email'] ?? '');
        $funcionario->id_empresa = htmlspecialchars($_POST['id_empresa'] ?? '');

        if ($funcionario->update()) {
            header('Location: funcionarioController.php?action=index');
            exit();
        } else {
            $error = "Erro ao atualizar funcionário.";
            include '../view/funcionario/edit.php';
        }
    }

    public function excluir(){
        global $db;
        $funcionario = new Funcionario($db);
        $funcionario->id_funcionario = htmlspecialchars($_GET['id'] ?? '');

        if ($funcionario->delete()) {
            header('Location: funcionarioController.php?action=index');
            exit();
        } else {
            $error = "Erro ao excluir funcionário.";
            include '../view/funcionario/edit.php';
        }
    }
}


if (isset($_GET['action'])) {
    $controller = new funcionarioController();
    if ($_GET['action'] == 'index') {
        $controller->index();

    } elseif ($_GET['action'] == 'cadastro') {
        $controller->cadastro();

     } elseif ($_GET['action'] == 'edit') {
        $controller->edit();

    } elseif ($_GET['action'] == 'create') {
        $controller->create();

    } elseif ($_GET['action'] == 'update') {
        $controller->update();

    } elseif ($_GET['action'] == 'excluir') {
        $controller->excluir();
    } else {
        header('Location: ../view/index.php');
        exit();
    }
} else {
    header('Location: ../view/index.php');
    exit();
}
?>