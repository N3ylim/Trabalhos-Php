<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Qualidade</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Controle Qualidade/Css/Controle.css">
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

    <div class="confirmation-overlay" id="confirmationOverlay">
        <div class="confirmation-box">
            <p>Tem certeza que deseja excluir?</p>
            <form id="confirmationForm" action='/Codigo/Php/Pagina Inicial/Controle Qualidade/Excluir/excluir_controle_qualidade.php' method='post'>
                <input type='hidden' name='id' id='confirmationId' value=''>
                <button type='submit' class='confirm-delete-btn'>Confirmar</button>
                <button type='button' class='cancel-btn' onclick='hideConfirmation()'>Cancelar</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h2>Controle de Qualidade de Veículos</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "zenith";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM controle_qualidade_veiculos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>ID Produção Veículo</th>
                        <th>Defeitos Encontrados</th>
                        <th>Status Qualidade</th>
                        <th>Ações</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["id_producao_veiculo"] . "</td>
                        <td>" . $row["defeitos_encontrados"] . "</td>
                        <td>" . $row["status_qualidade"] . "</td>
                        <td>
                            <form action='/Codigo/Php/Pagina Inicial/Controle Qualidade/Editar/editar_controle_qualidade.php' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' class='edit-btn'>Editar</button>
                            </form>
                            <form onsubmit='showConfirmation(\"" . $row["id"] . "\"); return false;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' class='delete-btn'>Excluir</button>
                            </form>
                        </td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum registro encontrado na tabela Controle Qualidade Veículos.";
        }

        $conn->close();
        ?>

        <form action='/Codigo/Php/Pagina Inicial/Controle Qualidade/Inserir/inserir_controle_qualidade.php' method='post'>
            <button type='submit' class='insert-btn'>Inserir Novo Controle de Qualidade</button>
        </form>

        <form action='/Codigo/Php/Pagina Inicial/Index/inicial.php' method='post'>
            <button type='submit' class='back-btn'>Voltar para a Página Inicial</button>
        </form>
    </div>

    <script>
        function showConfirmation(id) {
            document.getElementById('confirmationOverlay').style.display = 'flex';
            document.getElementById('confirmationId').value = id;
        }

        function hideConfirmation() {
            document.getElementById('confirmationOverlay').style.display = 'none';
        }
    </script>

</body>

</html>
