<!-- HTML (historico_tabelas.php) -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Tabelas</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Histórico/Css/Historico.css">
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
    <br>
    <br>
    <div class="container">
        <h2>Histórico de Tabelas</h2>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Histórico/historico_producao_veiculos.php'">Histórico Produção de
                Veículos</button>
        </div>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Histórico/historico_controle_qualidade.php'">Histórico Controle de
                Qualidade</button>
        </div>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Histórico/historico_logistica_distribuicao.php'">Histórico
                Logística e Distribuição</button>
        </div>

        <form action='/Codigo/Php/Pagina Inicial/Index/inicial.php' method='post'>
            <button type='submit' class='insert-btn'>Voltar para a Página Inicial</button>
        </form>
    </div>
</body>

</html>
