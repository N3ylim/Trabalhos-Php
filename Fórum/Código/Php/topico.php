<?php
require_once('config.php');
require_once('conexao.php');

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Processar formulário para enviar mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_topico = $_POST['id_topico'];
    $conteudo = $_POST['conteudo'];
    $id_autor = $_SESSION['usuario_id'];

    // Verifica se os campos estão preenchidos
    if (!empty($id_topico) && !empty($conteudo)) {
        $sql = "INSERT INTO mensagens (id_autor, id_topico, conteudo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $id_autor, $id_topico, $conteudo);

        if ($stmt->execute()) {
            $mensagens['sucesso'] = 'Mensagem enviada com sucesso.';
        } else {
            $mensagens['erro'] = 'Erro ao enviar mensagem.';
        }

        $stmt->close();
    } else {
        $mensagens['erro'] = 'Preencha todos os campos.';
    }
}

// Recuperar informações do tópico
$id_topico = $_GET['id'] ?? null;
if ($id_topico) {
    $sql_topico = "SELECT id, id_autor, titulo FROM topicos WHERE id = ?";
    $stmt_topico = $conn->prepare($sql_topico);
    $stmt_topico->bind_param("i", $id_topico);
    $stmt_topico->execute();
    $result_topico = $stmt_topico->get_result();

    if ($result_topico->num_rows > 0) {
        $topico = $result_topico->fetch_assoc();

        // Recuperar mensagens do tópico
        $sql_mensagens = "SELECT m.id, m.id_autor, m.conteudo, m.imagem, m.data_envio, u.nome 
                          FROM mensagens m 
                          INNER JOIN usuarios u ON m.id_autor = u.id 
                          WHERE m.id_topico = ?
                          ORDER BY m.data_envio ASC";
        $stmt_mensagens = $conn->prepare($sql_mensagens);
        $stmt_mensagens->bind_param("i", $id_topico);
        $stmt_mensagens->execute();
        $result_mensagens = $stmt_mensagens->get_result();

        $mensagens = array();
        while ($row = $result_mensagens->fetch_assoc()) {
            $mensagens[] = $row;
        }
    } else {
        header('Location: forum.php');
        exit();
    }

    $stmt_topico->close();
    $stmt_mensagens->close();
} else {
    header('Location: forum.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $topico['titulo']; ?></title>
    <link rel="stylesheet" href="../Css/forum.css"> <!-- Incluindo o estilo forum.css -->
    <style>
        /* Estilos adicionais específicos para esta página, se necessário */
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $topico['titulo']; ?></h1>
        <p><a href="forum.php">Voltar para o Fórum</a></p>

        <!-- Formulário para enviar mensagem -->
        <?php if (!empty($mensagens['erro'])): ?>
            <div class="erro"><?php echo $mensagens['erro']; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensagens['sucesso'])): ?>
            <div class="sucesso"><?php echo $mensagens['sucesso']; ?></div>
        <?php endif; ?>
        <form action="topico.php?id=<?php echo $id_topico; ?>" method="POST">
            <input type="hidden" name="id_topico" value="<?php echo $id_topico; ?>">
            <label for="conteudo">Escreva sua mensagem:</label><br>
            <textarea id="conteudo" name="conteudo" rows="4" required></textarea><br><br>
            <button type="submit">Enviar Mensagem</button>
        </form>

        <hr>

        <!-- Exibir mensagens do tópico -->
        <?php if (!empty($mensagens)): ?>
            <?php foreach ($mensagens as $mensagem): ?>
                <div class="mensagem">
                    <p><strong><?php echo $mensagem['nome']; ?></strong> - <?php echo $mensagem['data_envio']; ?></p>
                    <p><?php echo nl2br($mensagem['conteudo']); ?></p>
                    <?php if (!empty($mensagem['imagem'])): ?>
                        <img src="uploads/<?php echo $mensagem['imagem']; ?>" alt="Imagem anexada">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Ainda não há mensagens neste tópico.</p>
        <?php endif; ?>
    </div>
</body>
</html>
