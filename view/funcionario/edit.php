<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema - Editar Funcionário</title>
</head>
<body>
    <h2>Editar Funcionário</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="../controller/funcionarioController.php?action=update&id=<?php echo htmlspecialchars($funcionario['id_funcionario']); ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required><br><br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($funcionario['cpf']); ?>" required><br><br>
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" value="<?php echo htmlspecialchars($funcionario['rg']); ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($funcionario['email']); ?>" required><br><br>
        <label for="data_cadastro">Data Cadastro:</label>
        <input type="date" id="data_cadastro" name="data_cadastro" value="<?php echo htmlspecialchars($funcionario['data_cadastro']); ?>" required><br><br>
        <label for="salario">Salário:</label>
        <input type="text" id="salario" name="salario" value="<?php echo htmlspecialchars($funcionario['salario']); ?>" required><br><br>
        <label for="bonificacao">Bonificação:</label>
        <input type="text" id="bonificacao" name="bonificacao" value="<?php echo htmlspecialchars($funcionario['bonificacao']); ?>" required><br><br>
        <label for="id_empresa">Empresa:</label>
        <select id="id_empresa" name="id_empresa" required>
            <option value="">Selecione uma empresa</option>
            <?php foreach ($empresas as $empresa): ?>
                <option value="<?php echo htmlspecialchars($empresa['id_empresa']); ?>" <?php echo ($empresa['id_empresa'] == $funcionario['id_empresa']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($empresa['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>