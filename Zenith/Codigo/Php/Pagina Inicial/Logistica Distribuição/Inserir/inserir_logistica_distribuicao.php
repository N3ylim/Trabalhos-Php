<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Logística e Distribuição</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Logistica Distribuição/Css/Inserir.css">
</head>

<body>

    <div class="container">
        <h2>Inserir Logística e Distribuição</h2>

        <form action="/Codigo/Php/Pagina Inicial/Logistica Distribuição/Inserir/processar_inserir_logistica_distribuicao.php" method="post">
            <label for="id_producao_veiculo">ID Produção Veículo:</label>
            <select id="id_producao_veiculo" name="id_producao_veiculo" required>
                <?php
                // Use essas variáveis para conectar ao seu banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "zenith";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, modelo FROM producao_veiculos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["id"] . " - " . $row["modelo"] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required>

            <label for="metodo_envio">Método de Envio:</label>
            <input type="text" id="metodo_envio" name="metodo_envio" required>

            <button type="submit" class="submit-btn">Inserir</button>
        </form>
    </div>

</body>

</html>
