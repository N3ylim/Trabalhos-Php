<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "zenith";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$message = ''; // Mensagem vazia por padrão
$redirectTo = ''; // Controla para onde redirecionar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT id, nome, sobrenome, email, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuário já cadastrado
        $message = "Você já está cadastrado. Redirecionando para a página de login...";
        $redirectTo = '/Codigo/Php/Login/login.php';
    } else {
        // Cadastro bem-sucedido
        $stmt->close();
        
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $senhaHash = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        $sqlCadastro = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";
        $stmtCadastro = $conn->prepare($sqlCadastro);
        $stmtCadastro->bind_param("ssss", $nome, $sobrenome, $email, $senhaHash);

        if ($stmtCadastro->execute()) {
            $message = "Cadastro realizado com sucesso. Redirecionando para a página de login...";
            $redirectTo = '/Codigo/Php/Login/login.php';
        } else {
            $message = "Erro ao cadastrar: " . $stmtCadastro->error;
        }

        $stmtCadastro->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <style>
        /* Estilos da tela de carregamento */
        #loadingScreen {
            display: none; /* Inicialmente escondido */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #2c3e50, #273746);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column; /* Adicionado para alinhar verticalmente */
        }

        .loader {
            border: 8px solid #f3f3f3; /* Light grey */
            border-top: 8px solid rgba(0, 0, 0, 0.281);; /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        #loadingMessage {
            margin-top: 20px; /* Ajuste de margem */
            color: white;
            font-family: Arial; /* Define a fonte como Arial */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div id="loadingScreen">
    <div class="loader"></div>
    <p id="loadingMessage">Carregando...</p>
</div>

<!-- Seu formulário de cadastro aqui -->

<script>
    let redirectTo = '<?php echo $redirectTo; ?>';
    let message = '<?php echo $message; ?>';

    if (message !== '') {
        alert(message);
    }

    if (redirectTo !== '') {
        document.getElementById('loadingScreen').style.display = 'flex';
        document.getElementById('loadingMessage').innerText = 'Redirecionando para a página de login...';
        setTimeout(function() {
            window.location.href = redirectTo;
        }, 2000); // Mostra a tela de carregamento por 2 segundos antes do redirecionamento
    }
</script>

</body>
</html>
