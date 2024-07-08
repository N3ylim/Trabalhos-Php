<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" type="text/css" href="/Codigo/Php/Login/Css/login.css">
</head>

<body>

    <div class="login-container">
        <h2>Tela de Login</h2>
        <form action="/Codigo/Php/Login/autenticar.php" method="post" class="login-form">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <br>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>

</html>
