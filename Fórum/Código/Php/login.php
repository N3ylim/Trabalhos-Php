<?php
require_once('config.php');
require_once('conexao.php');

session_start();

$mensagens = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            $mensagens['sucesso'] = 'Login realizado com sucesso. Redirecionando...';
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'forum.php';
                    }, 1000); // Redireciona após 2 segundos
                  </script>";
        } else {
            $mensagens['erro'] = 'Senha incorreta.';
        }
    } else {
        $mensagens['erro'] = 'Usuário não encontrado.';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/formulario.css">
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <?php if (!empty($mensagens['erro'])): ?>
            <div class="erro"><?php echo $mensagens['erro']; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensagens['sucesso'])): ?>
            <div class="sucesso"><?php echo $mensagens['sucesso']; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
        <br>
        <p>Ainda não tem cadastro? <a href="cadastro.php">Cadastre-se aqui.</a></p>
    </div>
</body>
</html>
