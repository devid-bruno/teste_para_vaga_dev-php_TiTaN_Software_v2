<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="../controller/loginController.php?action=login" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login"><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>