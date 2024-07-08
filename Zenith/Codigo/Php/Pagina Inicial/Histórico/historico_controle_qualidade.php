<!-- HTML (historico_controle_qualidade.php) -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico Controle de Qualidade</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Histórico/Css/Tabelas.Css">
</head>

<body>

    <?php
    session_start();

    // Verificar se o usuário está autenticado
    if (isset($_SESSION['usuario_id'])) {
        // Exibir informações do usuário
        $usuario_nome = $_SESSION['usuario_nome'];
        $usuario_sobrenome = $_SESSION['usuario_sobrenome'];
        $usuario_email = $_SESSION['usuario_email'];

        echo "<div class='user-info'>
            <p><strong>Usuário:</strong> $usuario_nome $usuario_sobrenome</p>
            <p><strong>Email:</strong> $usuario_email</p>
        </div>";

    } else {
        // Redirecionar para a página de login se o usuário não estiver autenticado
        header("Location: /Codigo/Php/Login/login.php");
        exit();
    }
    ?>

    <div class="container">
        <h2>Histórico Controle de Qualidade</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "zenith";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM log_controle_qualidade_veiculos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Horário</th>
                        <th>ID Controle Qualidade Veículo</th>
                        <th>Ação</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["timestamp"] . "</td>
                        <td>" . $row["id_controle_qualidade_veiculo"] . "</td>
                        <td>" . $row["acao"] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum registro encontrado no histórico de Controle de Qualidade.";
        }

        $conn->close();
        ?>

        <!-- Adicionando o botão de voltar para a página inicial -->    
        <br>
        <form action='/Codigo/Php/Pagina Inicial/Histórico/historico_tabelas.php' method='post'>
            <button type='submit' class='insert-btn'>Voltar para página de Histórico</button>
        </form>
    </div>
</body>

</html>
