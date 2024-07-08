<!-- HTML (inserir_controle_qualidade.php) -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Controle de Qualidade</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Controle Qualidade/Css/Inserir.css">
</head>

<body>

    <div class="container">
        <h2>Inserir Controle de Qualidade</h2>

        <form action="/Codigo/Php/Pagina Inicial/Controle Qualidade/Inserir/processar_inserir_controle_qualidade.php" method="post">
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

            <label for="defeitos_encontrados">Defeitos Encontrados:</label>
            <input type="text" id="defeitos_encontrados" name="defeitos_encontrados" required>

            <label for="status_qualidade">Status Qualidade:</label>
            <input type="text" id="status_qualidade" name="status_qualidade" required>

            <button type="submit" class="submit-btn">Inserir</button>
        </form>
    </div>

</body>

</html>
