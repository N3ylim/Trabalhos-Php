<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producao_veiculo = $_POST["id_producao_veiculo"];
    $destino = $_POST["destino"];
    $metodo_envio = $_POST["metodo_envio"];

    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO logistica_distribuicao_veiculos (id_producao_veiculo, destino, metodo_envio)
            VALUES ('$id_producao_veiculo', '$destino', '$metodo_envio')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso.";
        // Redireciona para a página de logística e distribuição após a inserção
        header("Location: /Codigo/Php/Pagina Inicial/Logistica Distribuição/logistica_distribuicao.php");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    $conn->close();
}
?>
