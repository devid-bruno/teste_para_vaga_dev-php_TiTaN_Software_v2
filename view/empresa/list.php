<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Sistema - Listar Empresas</title>
</head>
<body class="container">
    <h2>Total de empresa cadastradas: <?php echo $total_empresas ?></h2>
    <a href="../controller/loginController.php?action=logout">Logout</a>
    <a href="../controller/funcionarioController.php?action=index">Ver tabela de funcionários</a>
    <a href="../controller/empresaController.php?action=listar">Exportar em PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>
                    empresa
                </th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
                <tr>
                    <td><?php echo htmlspecialchars($empresa['nome']); ?></td>
                    <td>
                        <a href="../controller/empresaController.php?action=edit&id=<?php echo htmlspecialchars($empresa['id_empresa']); ?>">Editar</a>
                        <a href="../controller/empresaController.php?action=excluir&id=<?php echo htmlspecialchars($empresa['id_empresa']); ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>