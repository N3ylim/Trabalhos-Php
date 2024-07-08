<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ATENDIMENTO";

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para pegar os pedidos prioritários pendentes
    $stmt = $conn->prepare("SELECT id, senha, data_hora FROM Cliente WHERE tipo = 'prioritario' AND status = 'pendente' ORDER BY data_hora ASC LIMIT 5");
    $stmt->execute();
    $prioritarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para pegar os pedidos normais pendentes
    $stmt = $conn->prepare("SELECT id, senha, data_hora FROM Cliente WHERE tipo = 'normal' AND status = 'pendente' ORDER BY data_hora ASC LIMIT 5");
    $stmt->execute();
    $normais = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['prioritarios' => $prioritarios, 'normais' => $normais]);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conn = null; // Fecha a conexão
?>
