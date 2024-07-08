<?php
session_start();

if (isset($_SESSION['professor_id'])) {
    header("Location: painel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    </nav>

    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Bem-vindo ao Sistema de Gerenciamento de Turmas</h1>
            <p class="lead">Faça login ou registre-se para começar.</p>
            <br>
            <a class="btn btn-primary" href="login.php" role="button">Entrar</a>
            <a class="btn btn-primary" href="registrar.php" role="button">Registrar-se</a>
        </div>
    </div>

    <footer class="footer">
        </div>
    </footer>

</body>

</html>
