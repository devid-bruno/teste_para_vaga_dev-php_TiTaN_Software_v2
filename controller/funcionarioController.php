<?php
session_start();
include_once '../db.php';
include_once '../model/Funcionario.php';
include_once '../model/Empresa.php';
require('../libs/fpdf/fpdf.php');

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
        $funcionario->data_cadastro = htmlspecialchars($_POST['data_cadastro'] ?? '');
        $funcionario->salario = htmlspecialchars($_POST['salario'] ?? '');
        $funcionario->bonificacao = htmlspecialchars($_POST['bonificacao'] ?? '');
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
        $funcionario->data_cadastro = htmlspecialchars($_POST['data_cadastro'] ?? '');
        $funcionario->salario = htmlspecialchars($_POST['salario'] ?? '');
        $funcionario->bonificacao = htmlspecialchars($_POST['bonificacao'] ?? '');
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

    public function exportpdf(){
    global $db;
    $funcionario = new Funcionario($db);
    $stmt = $funcionario->read();
    $funcionarios = [];
    if ($stmt) {
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    //altura e largura pdf
    $colWidths = [50, 35, 30, 65, 19];
    $header = ['Nome', 'CPF', 'RG', 'Email', 'Empresa'];

    // estiliando o pdf
    $pdf->SetFillColor(200, 220, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(50, 50, 100);
    $pdf->SetLineWidth(.3);

    for ($i = 0; $i < count($header); $i++) {
        $pdf->Cell($colWidths[$i], 7, $header[$i], 1, 0, 'C', true);
    }
    $pdf->Ln();

    //
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->SetTextColor(0);
    $fill = false;

    foreach ($funcionarios as $funcionario) {
        $pdf->Cell($colWidths[0], 6, mb_convert_encoding($funcionario['nome'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
        $pdf->Cell($colWidths[1], 6, $funcionario['cpf'], 1, 0, 'L', $fill);
        $pdf->Cell($colWidths[2], 6, $funcionario['rg'], 1, 0, 'L', $fill);
        $pdf->Cell($colWidths[3], 6, mb_convert_encoding($funcionario['email'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fill);
        $pdf->Cell($colWidths[4], 6, $funcionario['id_empresa'], 1, 0, 'L', $fill);
        $pdf->Ln();
        $fill = !$fill;
    }

    // Output PDF
    $pdf->Output();
}

}


if (isset($_GET['action'])) {
    $controller = new funcionarioController();
    if ($_GET['action'] == 'index') {
        $controller->index();

    } elseif ($_GET['action'] == 'exportpdf') {
        $controller->exportpdf();

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