<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema - Novo Funcionário</title>
</head>
<body>
    <h2>Cadastrar Novo Funcionário</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="../controller/funcionarioController.php?action=create" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="data_cadastro">Data Cadastro:</label>
        <input type="date" id="data_cadastro" name="data_cadastro" required><br><br>
        <label for="salario">Salário:</label>
        <input type="text" id="salario" name="salario" required><br><br>
        <label for="bonificacao">Bonificação:</label>
        <input type="text" id="bonificacao" name="bonificacao" required><br><br>
        <label for="id_empresa">Empresa:</label>
        <select id="id_empresa" name="id_empresa" required>
            <option value="">Selecione uma empresa</option>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?php echo htmlspecialchars($empresa['id_empresa']); ?>">
                    <?php echo htmlspecialchars($empresa['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>