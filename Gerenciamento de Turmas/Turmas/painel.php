<?php
session_start();
if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$stmt = $pdo->prepare("SELECT username FROM professores WHERE id = ?");
$stmt->execute([$_SESSION['professor_id']]);
$professor = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM turmas WHERE professor_id = ?");
$stmt->execute([$_SESSION['professor_id']]);
$turmas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Professor</title>
    <link rel="stylesheet" href="css/painel.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Painel do Professor</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text">Bem-vindo, <?php echo htmlspecialchars($professor['username']); ?></span>
                </li>
                <li class="nav-item">
                    <a href="sair.php" class="nav-link btn btn-danger">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h3>Suas Turmas</h3>
        <form method="post" action="turmas.php">
            <div class="form-group spaced">
                <input type="text" name="name" class="form-control" placeholder="Nome da Turma" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Adicionar Turma</button>
            <br>
            <br>
        </form>
        <div class="row mt-4">
            <?php foreach ($turmas as $turma) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo htmlspecialchars($turma['name']); ?></h3>
                        </div>
                        <br>
                        <div class="card-body">
                            <a href="atividades.php?turma_id=<?php echo $turma['id']; ?>" class="btn btn-primary btn-sm">Ver Atividades</a>
                            <a href="excluir_turma.php?id=<?php echo $turma['id']; ?>" class="nav-link btn btn-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (isset($error_message)) : ?>
            <div class="alert" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
