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
    <style>
        .bonificado {
            background-color: #ADD8E6;
        }
        .bonificacao5anos{
            background-color: #FF6347;
        }
    </style>
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
    <a href="../controller/funcionarioController.php?action=exportpdf">Exportar em PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Email</th>
                <th>Data Cadastro</th>
                <th>Salário</th>
                <th>Bonificação</th>
                <th>Empresa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $funcionario): ?>
                <?php
                // calculo de diferença da data do funcionario comparado a data atual
                $data_cadastro = new DateTime($funcionario['data_cadastro']);
                $data_atual = new DateTime();
                $intervalo = $data_cadastro->diff($data_atual);

                // verifica tempo de funcionario ativo
                $bonificado = false;
                $classe_bonificacao = '';
                if ($intervalo->y >= 5) {
                    $bonificado = true;
                    $funcionario['bonificacao'] = $funcionario['salario'] * 0.20; // 20% do salario
                    $classe_bonificacao = 'bonificacao5anos';
                } elseif ($intervalo->y >= 1) {
                    $bonificado = true;
                    $funcionario['bonificacao'] = $funcionario['salario'] * 0.10; // 10% do salario
                    $classe_bonificacao = 'bonificado';
                }
                ?>
                <tr class="<?php echo $classe_bonificacao; ?>">
                    <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['rg']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['email']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($funcionario['data_cadastro'])); ?></td>
                    <td><?php echo 'R$ ' . number_format($funcionario['salario'], 2, ',', '.'); ?></td>
                    <td><?php echo 'R$ ' . number_format($funcionario['bonificacao'], 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['nome_empresa']); ?></td>
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