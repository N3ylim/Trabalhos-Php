<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="/Codigo/Php/Cadastro/Css/cadastro.css">
</head>

<body>

    <div class="login-container">
        <h2>Cadastro</h2>
        <form action="cadastrar.php" method="post" class="login-form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <br>
            <br>
            <input type="submit" value="Criar Conta">
        </form>
    </div>
</body>

</html>
