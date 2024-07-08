<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Use essas variáveis para conectar ao seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zenith";

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Inicia uma transação
    $conn->begin_transaction();

    try {
        // Exclui registros relacionados na tabela log_controle_qualidade_veiculos
        $sqlDeleteLogControle = "DELETE FROM log_controle_qualidade_veiculos WHERE id_controle_qualidade_veiculo IN (SELECT id FROM controle_qualidade_veiculos WHERE id_producao_veiculo = $id)";
        $conn->query($sqlDeleteLogControle);

        // Exclui registros na tabela controle_qualidade_veiculos
        $sqlDeleteControle = "DELETE FROM controle_qualidade_veiculos WHERE id_producao_veiculo = $id";
        $conn->query($sqlDeleteControle);

        // Exclui registros relacionados na tabela log_logistica
        $sqlDeleteLogLogistica = "DELETE FROM log_logistica WHERE id_logistica_veiculo IN (SELECT id FROM logistica_distribuicao_veiculos WHERE id_producao_veiculo = $id)";
        $conn->query($sqlDeleteLogLogistica);

        // Exclui registros na tabela logistica_distribuicao_veiculos
        $sqlDeleteLogistica = "DELETE FROM logistica_distribuicao_veiculos WHERE id_producao_veiculo = $id";
        $conn->query($sqlDeleteLogistica);

        // Exclui registro na tabela producao_veiculos
        $sqlDeleteProducao = "DELETE FROM producao_veiculos WHERE id = $id";
        $conn->query($sqlDeleteProducao);

        // Confirma a transação
        $conn->commit();

        echo "Registro e registros relacionados excluídos com sucesso.";
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        $conn->rollback();

        echo "Erro ao excluir registros: " . $e->getMessage();
    }

    $conn->close();

    // Redireciona para a página de producao_veiculos.php após excluir
    header("Location: /Codigo/Php/Pagina Inicial/Produção Veiculos/producao_veiculos.php");
    exit();
}
?>
