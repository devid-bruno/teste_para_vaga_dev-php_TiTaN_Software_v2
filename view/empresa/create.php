<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema - Nova Empresa</title>
</head>
<body>
    <h2>Empresa</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="../controller/empresaController.php?action=create" method="post">
        <label for="nome">Nome :</label>
        <input type="text" id="nome" name="nome"><br><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>