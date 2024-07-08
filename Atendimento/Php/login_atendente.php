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
    
    // Consulta SQL para verificar o usuário e senha
    $stmt = $conn->prepare("SELECT * FROM Atendente WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou algum registro
    if ($result) {
        // Verifica se a senha está correta
        if ($senha === $result['senha']) {
            // Login bem-sucedido, redireciona para a tela do atendente
            echo "<script>alert('Login bem-sucedido!'); window.location.href = '../Html/Atendente/tela_atendente.html';</script>";
            exit; // Encerra o script após o redirecionamento
        } else {
            // Senha incorreta, exibir pop-up e redirecionar para a tela de login
            echo "<script>alert('Senha incorreta!'); window.location.href = '../Html/Atendente/login_atendente.html';</script>";
            exit; // Encerra o script após o redirecionamento
        }
    } else {
        // Usuário não encontrado, exibir pop-up e redirecionar para a tela de login
        echo "<script>alert('Usuário não encontrado!'); window.location.href = '../Html/Atendente/login_atendente.html';</script>";
        exit; // Encerra o script após o redirecionamento
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fecha a conexão
?>
