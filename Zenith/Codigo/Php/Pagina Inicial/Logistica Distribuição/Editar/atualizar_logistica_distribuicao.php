<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
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

    $sql = "UPDATE logistica_distribuicao_veiculos SET id_producao_veiculo = $id_producao_veiculo, destino = '$destino', metodo_envio = '$metodo_envio' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }

    $conn->close();

    // Redireciona para a página de logistica_distribuicao.php após atualizar
    header("Location: /Codigo/Php/Pagina Inicial/Logistica Distribuição/logistica_distribuicao.php");
    exit();
}
?>
