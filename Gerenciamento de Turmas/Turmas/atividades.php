<?php
session_start();

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

$stmt = $pdo->prepare("SELECT username FROM professores WHERE id = ?");
$stmt->execute([$_SESSION['professor_id']]);
$professor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($_GET['turma_id'])) {
    header("Location: painel.php?error=missing_turma_id");
    exit();
}

$turma_id = $_GET['turma_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['description'])) {
    if (empty($_POST['description'])) {
        header("Location: atividades.php?turma_id=$turma_id&error=empty_description");
        exit();
    }

    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO atividades (class_id, description) VALUES (?, ?)");
    $stmt->execute([$turma_id, $description]);

    header("Location: atividades.php?turma_id=$turma_id");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $pdo->prepare("DELETE FROM atividades WHERE id = ?");
    $stmt->execute([$delete_id]);

    header("Location: atividades.php?turma_id=$turma_id");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM atividades WHERE class_id = ?");
$stmt->execute([$turma_id]);
$atividades = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Bem-vindo, <?php echo htmlspecialchars($professor['username']); ?>!</a>
            <a href="painel.php" class="btn-sair">Voltar ao Painel</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-5 pt-4">Atividades</h2>

        <?php
        $stmt_turma = $pdo->prepare("SELECT name FROM turmas WHERE id = ?");
        $stmt_turma->execute([$turma_id]);
        $turma_info = $stmt_turma->fetch(PDO::FETCH_ASSOC);
        ?>

        <h3>Turma: <?php echo htmlspecialchars($turma_info['name']); ?></h3>

        <form method="post" class="mt-4" action="atividades.php?turma_id=<?php echo $turma_id; ?>">
            <div class="form-group">
                <textarea name="description" class="form-control" placeholder="Descrição da Atividade" required></textarea>
            </div>
            <button type="submit" class="btn-primary">Adicionar Atividade</button>
            <br>
            <br>
        </form>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'empty_description') : ?>
            <div class="alert" role="alert">
                A descrição da atividade é obrigatória.
            </div>
        <?php endif; ?>

        <ul class="list-group mt-3">
            <?php foreach ($atividades as $atividade) : ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($atividade['description']); ?>
                    <form method="post" class="m-0">
                        <input type="hidden" name="delete_id" value="<?php echo $atividade['id']; ?>">
                        <button type="submit" class="btn-sm">Excluir</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>
