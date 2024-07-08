<?php
require_once('config.php');
require_once('conexao.php');

$mensagens = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        $mensagens['sucesso'] = 'Cadastro realizado com sucesso.';
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 1000); // Redireciona após 2 segundos
              </script>";
    } else {
        $mensagens['erro'] = 'Erro ao cadastrar usuário.';
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../Css/formulario.css">
</head>
<body>
    <div class="form-container">
        <h1>Cadastro de Usuário</h1>
        <?php if (!empty($mensagens['erro'])): ?>
            <div class="erro"><?php echo $mensagens['erro']; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensagens['sucesso'])): ?>
            <div class="sucesso"><?php echo $mensagens['sucesso']; ?></div>
        <?php endif; ?>
        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="button">Cadastrar</button>
        </form>
        <br>
        <p>Já tem cadastro? <a href="login.php">Faça login aqui.</a></p>
    </div>
</body>
</html>
