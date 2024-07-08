<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $modelo = $_POST["modelo"];
    $quantidade_produzida = $_POST["quantidade_produzida"];
    $linha_producao = $_POST["linha_producao"];

    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Atualizar os dados na tabela producao_veiculos
    $sql = "UPDATE producao_veiculos SET modelo='$modelo', quantidade_produzida=$quantidade_produzida, linha_producao='$linha_producao' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de producao_veiculos.php após a atualização
        header("Location: /Codigo/Php/Pagina Inicial/Produção Veiculos/producao_veiculos.php");
        exit(); // Certifique-se de parar a execução após o redirecionamento
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }

    $conn->close();
}
?>
