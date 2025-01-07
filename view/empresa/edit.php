<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema - Editar Empresa</title>
</head>
<body>
    <h2>Editar Empresa</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="../controller/empresaController.php?action=update&id=<?php echo htmlspecialchars($empresa['id_empresa']); ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($empresa['nome']); ?>" required><br><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>