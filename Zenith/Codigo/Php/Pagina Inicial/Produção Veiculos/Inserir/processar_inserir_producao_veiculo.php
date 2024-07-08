<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Coletar dados do formulário
    $modelo = $_POST["modelo"];
    $quantidade = $_POST["quantidade"];
    $linha_producao = $_POST["linha_producao"];

    // Inserir dados no banco de dados
    $sql = "INSERT INTO producao_veiculos (modelo, quantidade_produzida, linha_producao) VALUES ('$modelo', $quantidade, '$linha_producao')";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de produção de veículos
        header("Location: /Codigo/Php/Pagina Inicial/Produção Veiculos/producao_veiculos.php");
        exit(); // Certifique-se de parar a execução após o redirecionamento
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    $conn->close();
}
?>
