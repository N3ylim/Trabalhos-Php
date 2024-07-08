<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
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

    $sql = "UPDATE controle_qualidade_veiculos SET id_producao_veiculo = $id_producao_veiculo, defeitos_encontrados = '$defeitos_encontrados', status_qualidade = '$status_qualidade' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }

    $conn->close();

    // Redireciona para a página de controle_qualidade.php após atualizar
    header("Location: /Codigo/Php/Pagina Inicial/Controle Qualidade/controle_qualidade.php");
    exit();
}
?>
