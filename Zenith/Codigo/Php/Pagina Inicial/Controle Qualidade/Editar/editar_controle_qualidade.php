<!-- HTML (editar_controle_qualidade.php) -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Controle de Qualidade</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Controle Qualidade/Css/Editar.css">
</head>

<body>

    <div class="edit-container">
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

            $sql = "SELECT * FROM controle_qualidade_veiculos WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Aqui você pode exibir um formulário preenchido com os dados atuais e permitir a edição
                echo "<h2>Editar Controle de Qualidade</h2>
                    <form action='/Codigo/Php/Pagina Inicial/Controle Qualidade/Editar/atualizar_controle_qualidade.php' method='post' class='edit-form'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <label for='id_producao_veiculo'>ID Produção Veículo:</label>
                        <input type='number' id='id_producao_veiculo' name='id_producao_veiculo' value='" . $row["id_producao_veiculo"] . "' readonly>
                        <label for='defeitos_encontrados'>Defeitos Encontrados:</label>
                        <input type='text' id='defeitos_encontrados' name='defeitos_encontrados' value='" . $row["defeitos_encontrados"] . "' required>
                        <label for='status_qualidade'>Status Qualidade:</label>
                        <input type='text' id='status_qualidade' name='status_qualidade' value='" . $row["status_qualidade"] . "' required>
                        <br>
                        <br>
                        <input type='submit' value='Atualizar'>
                    </form>";
            } else {
                echo "Registro não encontrado.";
            }

            $conn->close();
        }
        ?>
    </div>
</body>

</html>
