<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producao_veiculo = $_POST["id_producao_veiculo"];
    $defeitos_encontrados = $_POST["defeitos_encontrados"];
    $status_qualidade = $_POST["status_qualidade"];

    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO controle_qualidade_veiculos (id_producao_veiculo, defeitos_encontrados, status_qualidade)
            VALUES ('$id_producao_veiculo', '$defeitos_encontrados', '$status_qualidade')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso.";
        // Redireciona para a página de controle de qualidade após a inserção
        header("Location: /Codigo/Php/Pagina Inicial/Controle Qualidade/controle_qualidade.php");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    $conn->close();
}
?>
