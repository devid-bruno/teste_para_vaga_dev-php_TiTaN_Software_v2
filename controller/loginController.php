<?php
session_start();
include_once '../db.php';
$database = new Database();
$db = $database->getConnection();

class loginController {
    public function login() {
        $username = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['senha']);

        if (!empty($username) && !empty($password)) {
            $query = "SELECT * FROM tbl_usuarios WHERE login = :username AND senha = :password";
            $stmt = $GLOBALS['db']->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['login'] = $username;
                header('Location: funcionarioController.php?action=index');
                exit();
            } else {
                $error = "Credenciais inválidas.";
                include '../view/index.php';
            }
        } else {
            $error = "Por favor, preencha todos os campos.";
            include '../view/index.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../view/index.php');
        exit();
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $controller = new loginController();
    $controller->login();
} elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $controller = new loginController();
    $controller->logout();
} else {
    header('Location: ../view/index.php');
    exit();
}
?>