<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ATENDIMENTO";

// Obtém o ID do pedido do corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Atualiza o status do pedido para 'concluído'
    $stmt = $conn->prepare("UPDATE Cliente SET status = 'concluido' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conn = null; // Fecha a conexão
?>


