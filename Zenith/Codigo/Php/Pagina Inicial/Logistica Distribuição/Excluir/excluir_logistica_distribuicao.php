<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM logistica_distribuicao_veiculos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Erro ao excluir registro: " . $conn->error;
    }

    $conn->close();

    // Redireciona para a página de logistica_distribuicao.php após excluir
    header("Location: /Codigo/Php/Pagina Inicial/Logistica Distribuição/logistica_distribuicao.php");
    exit();
}
?>
