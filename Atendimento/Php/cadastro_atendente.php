<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ATENDIMENTO";

// Dados do formulário
$usuario = $_POST['username'];
$senha = $_POST['password'];

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Define para lançar uma exceção em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepara a query SQL para inserir dados na tabela Atendente
    $stmt = $conn->prepare("INSERT INTO Atendente (usuario, senha) VALUES (:usuario, :senha)");
    
    // Bind dos parâmetros
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    
    // Executa a query
    $stmt->execute();

    // Mensagem de sucesso
    echo "<script>alert('Atendente cadastrado com sucesso!'); window.location.href = '../Html/Administrador/tela_adm.html';</script>";
    exit; // Encerra o script após o redirecionamento

} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fecha a conexão
?>
