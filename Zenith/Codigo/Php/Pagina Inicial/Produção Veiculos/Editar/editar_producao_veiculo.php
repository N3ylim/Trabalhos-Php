<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações do Veículo</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Produção Veiculos/Css/Editar.css">
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

            $sql = "SELECT * FROM producao_veiculos WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Aqui você pode exibir um formulário preenchido com os dados atuais e permitir a edição
                echo "<h2>Editar Informações do Veículo</h2>
                    <form action='/Codigo/Php/Pagina Inicial/Produção Veiculos/Editar/atualizar_producao_veiculo.php' method='post' class='edit-form'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <label for='modelo'>Modelo:</label>
                        <input type='text' id='modelo' name='modelo' value='" . $row["modelo"] . "' required>
                        <label for='quantidade_produzida'>Quantidade Produzida:</label>
                        <input type='number' id='quantidade_produzida' name='quantidade_produzida' value='" . $row["quantidade_produzida"] . "' required>
                        <label for='linha_producao'>Linha de Produção:</label>
                        <input type='text' id='linha_producao' name='linha_producao' value='" . $row["linha_producao"] . "' required>
                        <br>
                        <br>
                        <input type='submit'value='Atualizar'>
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
