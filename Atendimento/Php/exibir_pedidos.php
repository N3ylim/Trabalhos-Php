<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ATENDIMENTO";

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Define para lançar uma exceção em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta SQL para buscar os pedidos especiais ou normais
    $stmt = $conn->query("SELECT * FROM Cliente WHERE status = 'pendente'");
    
    // Verifica se encontrou algum registro
    if ($stmt->rowCount() > 0) {
        // Loop para exibir cada pedido
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tipo = $row['tipo'];
            $numero_pedido = $tipo == 'normal' ? 'N' . $row['id'] : 'E' . $row['id'];
            $tipo_pedido = $tipo == 'normal' ? 'Pedido Normal' : 'Pedido Prioritário';
            // Exibe o pedido
            echo "<div class='pedido'>";
            echo "<h3>$tipo_pedido</h3>";
            echo "<p>Número do Pedido: $numero_pedido</p>";
            echo "<button class='button'>Chamar</button>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhum pedido em espera.</p>";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fecha a conexão
?>
