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
    
    // Inicia a transação
    $conn->beginTransaction();
    
    // Cria a tabela Cliente se ela não existir
    $conn->exec("CREATE TABLE IF NOT EXISTS Cliente (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    senha VARCHAR(10) NOT NULL,
                    tipo ENUM('normal', 'prioritario') NOT NULL,
                    status ENUM('pendente', 'em_andamento', 'concluido') DEFAULT 'pendente',
                    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )");

    // Captura os parâmetros do POST
    $tipo = $_POST['tipo'];
    $senha = $_POST['senha'];

    // Prepara a query SQL para inserir dados
    $stmt = $conn->prepare("INSERT INTO Cliente (senha, tipo, status) VALUES (:senha, :tipo, 'pendente')");

    // Bind dos parâmetros
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);

    // Executa a query
    $stmt->execute();

    // Finaliza a transação
    $conn->commit();

    echo "Novo atendimento registrado com sucesso";
} catch(PDOException $e) {
    // Caso ocorra algum erro, faz rollback da transação
    $conn->rollback();
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fecha a conexão
?>
