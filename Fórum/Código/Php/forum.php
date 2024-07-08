<?php
require_once('config.php');
require_once('conexao.php');

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$mensagens = array(); // Inicializa o array de mensagens

// Processar formulário para criar novo tópico
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    // Verifica se os campos estão preenchidos
    if (!empty($titulo) && !empty($conteudo)) {
        $id_autor = $_SESSION['usuario_id'];

        // Insere novo tópico
        $sql = "INSERT INTO topicos (id_autor, titulo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $id_autor, $titulo);

        if ($stmt->execute()) {
            $id_topico = $stmt->insert_id;
            $stmt->close();

            // Insere a primeira mensagem no tópico
            $sql_mensagem = "INSERT INTO mensagens (id_autor, id_topico, conteudo) VALUES (?, ?, ?)";
            $stmt_mensagem = $conn->prepare($sql_mensagem);
            $stmt_mensagem->bind_param("iis", $id_autor, $id_topico, $conteudo);

            if ($stmt_mensagem->execute()) {
                $mensagens['sucesso'] = 'Tópico criado com sucesso.';
            } else {
                $mensagens['erro'] = 'Erro ao criar tópico.';
            }

            $stmt_mensagem->close();
        } else {
            $mensagens['erro'] = 'Erro ao criar tópico.';
        }
    } else {
        $mensagens['erro'] = 'Preencha todos os campos.';
    }
}

// Remoção de tópico se o usuário for o autor
if (isset($_GET['acao']) && $_GET['acao'] === 'remover' && isset($_GET['id'])) {
    $id_topico = $_GET['id'];
    $id_autor = $_SESSION['usuario_id'];

    // Verifica se o usuário logado é o autor do tópico
    $sql_verifica_autor = "SELECT id_autor FROM topicos WHERE id = ?";
    $stmt_verifica_autor = $conn->prepare($sql_verifica_autor);
    $stmt_verifica_autor->bind_param("i", $id_topico);
    $stmt_verifica_autor->execute();
    $stmt_verifica_autor->bind_result($id_autor_titulo);
    $stmt_verifica_autor->fetch();
    $stmt_verifica_autor->close(); // Fecha a consulta preparada

    if ($id_autor_titulo == $id_autor) {
        // Exclui o tópico e suas mensagens associadas
        $sql_delete_mensagens = "DELETE FROM mensagens WHERE id_topico = ?";
        $stmt_delete_mensagens = $conn->prepare($sql_delete_mensagens);
        $stmt_delete_mensagens->bind_param("i", $id_topico);
        $stmt_delete_mensagens->execute();
        $stmt_delete_mensagens->close();

        $sql_delete_topico = "DELETE FROM topicos WHERE id = ?";
        $stmt_delete_topico = $conn->prepare($sql_delete_topico);
        $stmt_delete_topico->bind_param("i", $id_topico);
        $stmt_delete_topico->execute();
        $stmt_delete_topico->close();

        // Redireciona para evitar reenvios de formulário
        header('Location: forum.php');
        exit();
    }
}

// Consulta os tópicos no banco de dados
$sql_consulta = "SELECT id, id_autor, titulo, data_criacao FROM topicos ORDER BY data_criacao DESC";
$result = $conn->query($sql_consulta);

$topicos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Consulta para contar as mensagens no tópico atual
        $sql_contagem = "SELECT COUNT(*) as total_mensagens FROM mensagens WHERE id_topico = " . $row['id'];
        $result_contagem = $conn->query($sql_contagem);
        $row_contagem = $result_contagem->fetch_assoc();
        $total_mensagens = $row_contagem['total_mensagens'];
        $result_contagem->close(); // Fecha o resultado da contagem

        // Consulta para obter a última mensagem no tópico atual
        $sql_ultima_mensagem = "SELECT id_autor, data_envio FROM mensagens WHERE id_topico = " . $row['id'] . " ORDER BY data_envio DESC LIMIT 1";
        $result_ultima_mensagem = $conn->query($sql_ultima_mensagem);
        if ($result_ultima_mensagem->num_rows > 0) {
            $row_ultima_mensagem = $result_ultima_mensagem->fetch_assoc();
            $autor_ultima_mensagem = $row_ultima_mensagem['id_autor'];
            $data_ultima_mensagem = $row_ultima_mensagem['data_envio'];
        } else {
            $autor_ultima_mensagem = 'N/A';
            $data_ultima_mensagem = 'N/A';
        }
        $result_ultima_mensagem->close(); // Fecha o resultado da última mensagem

        $row['total_mensagens'] = $total_mensagens;
        $row['autor_ultima_mensagem'] = $autor_ultima_mensagem;
        $row['data_ultima_mensagem'] = $data_ultima_mensagem;

        $topicos[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
    <link rel="stylesheet" href="../Css/forum.css">
</head>
<body>
    <div class="container">
        <h1>Fórum</h1>
        <p>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?> <a href="logout.php" class="sair-button">Sair</a></p>
        
        <!-- Formulário para criar novo tópico -->
        <h2>Novo Tópico</h2>
        <?php if (!empty($mensagens['erro'])): ?>
            <div class="erro"><?php echo $mensagens['erro']; ?></div>
        <?php endif; ?>
        <?php if (!empty($mensagens['sucesso'])): ?>
            <div class="sucesso"><?php echo $mensagens['sucesso']; ?></div>
        <?php endif; ?>
        <form action="forum.php" method="POST">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" required><br><br>
            <label for="conteudo">Conteúdo:</label><br>
            <textarea id="conteudo" name="conteudo" rows="4" required></textarea><br><br>
            <button type="submit">Criar Tópico</button>
        </form>

        <hr>

        <!-- Lista de tópicos existentes -->
        <h2>Tópicos</h2>
        <?php if (!empty($topicos)): ?>
            <ul>
                <?php foreach ($topicos as $topico): ?>
                    <li>
                        <a href="topico.php?id=<?php echo $topico['id']; ?>"><?php echo $topico['titulo']; ?></a>
                        - Criado por: <?php echo $topico['id_autor']; ?> em <?php echo $topico['data_criacao']; ?>
                        - Mensagens: <?php echo $topico['total_mensagens']; ?>
                        <?php if ($topico['total_mensagens'] > 0): ?>
                            - Última mensagem por: <?php echo $topico['autor_ultima_mensagem']; ?> em <?php echo $topico['data_ultima_mensagem']; ?>
                        <?php endif; ?>
                        <?php if ($topico['id_autor'] == $_SESSION['usuario_id']): ?>
                            - <a href="?acao=remover&id=<?php echo $topico['id']; ?>" onclick="return confirm('Tem certeza que deseja remover este tópico?')">Remover</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Ainda não há tópicos.</p>
        <?php endif; ?>
    </div>
    
</body>
</html>



