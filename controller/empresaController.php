<?php
session_start();
include_once('../db.php');
include_once('../model/empresa.php');

$database = new Database();
$db = $database->getConnection();

class empresaController{
    public function index(){
        include '../view/empresa/create.php';
    }

    public function create(){
        global $db;
        $empresa = new Empresa($db);
        $empresa->nome = $_POST['nome'];
        if ($empresa->insert()) {
            header('Location: funcionarioController.php?action=index');
            exit();
        } else {
            $error = "Erro ao cadastrar empresa.";
            include '../view/empresa/create.php';
        }
    }

    public function listar(){
        global $db;
        $empresa = new Empresa($db);
        $stmt = $empresa->read();
        $empresas = [];
        if ($stmt) {
            $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $total_empresas = count($empresas);
        include '../view/empresa/list.php';
    }

    public function edit(){
        global $db;
        $empresa = new Empresa($db);
        $empresa->id_empresa = htmlspecialchars($_GET['id'] ?? '');
        $stmt = $empresa->readOne();
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
        include '../view/empresa/edit.php';
    }

    public function update(){
        global $db;
        $empresa = new Empresa($db);
        $empresa->id_empresa = htmlspecialchars($_GET['id'] ?? '');
        $empresa->nome = htmlspecialchars($_POST['nome'] ?? '');
        if ($empresa->update()) {
            header('Location: empresaController.php?action=listar');
            exit();
        } else {
            $error = "Erro ao atualizar empresa.";
            include '../view/empresa/edit.php';
        }
    }

    public function excluir(){
        global $db;
        $empresa = new Empresa($db);
        $empresa->id_empresa = htmlspecialchars($_GET['id'] ?? '');
        if ($empresa->delete()) {
            header('Location: empresaController.php?action=listar');
            exit();
        } else {
            $error = "Erro ao excluir empresa.";
            include '../view/empresa/list.php';
        }
    }
}


if (isset($_GET['action'])) {
    $controller = new empresaController();
    if ($_GET['action'] == 'index') {
        $controller->index();

    } elseif ($_GET['action'] == 'create') {
        $controller->create();

    } elseif ($_GET['action'] == 'listar') {
        $controller->listar();
        
    } elseif ($_GET['action'] == 'update') {
        $controller->update();
        
    } elseif ($_GET['action'] == 'excluir') {
        $controller->excluir();
        
    } elseif ($_GET['action'] == 'edit') {
        $controller->edit();

    }else {
        header('Location: ../view/index.php');
        exit();
    }
} else {
    header('Location: ../view/index.php');
    exit();
}
?>