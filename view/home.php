<?php
    if (!isset($_SESSION['login'])) {
        $error = "Por favor, faça login para acessar o sistema.";
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Sistema - Home</title>
</head>
<body class="container">
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <h2>Bem-vindo</h2>
    <a href="../controller/loginController.php?action=logout">Logout</a>
    <a href="../controller/empresaController.php?action=index">Cadastrar nova Empresa</a>
    <a href="../controller/funcionarioController.php?action=cadastro">Cadastrar novo Funcionário</a>
    <a href="../controller/empresaController.php?action=listar">Ver Empresas</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Email</th>
                <th>Empresa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $funcionario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['rg']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['email']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['id_empresa']); ?></td>
                    <td>
                        <a href="../controller/funcionarioController.php?action=edit&id=<?php echo htmlspecialchars($funcionario['id_funcionario']); ?>">Editar</a>
                        <a href="../controller/funcionarioController.php?action=excluir&id=<?php echo htmlspecialchars($funcionario['id_funcionario']); ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>