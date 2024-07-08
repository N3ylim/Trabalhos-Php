<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Index/Css/inicial.css">
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

    // Adicionar botão de sair (logout)
    echo "<div class='logout-button' onclick='window.location.href=\"/Codigo/Php/Login/login.php\"'>Sair</div>";
} else {
    // Redirecionar para a página de login se o usuário não estiver autenticado
    header("Location: /Codigo/Php/Login/login.php");
    exit();
}
?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <h2>Bem-vindo à Página Principal</h2>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Produção Veiculos/producao_veiculos.php'">Produção de Veículos</button>
        </div>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Controle Qualidade/controle_qualidade.php'">Controle de Qualidade</button>
        </div>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Logistica Distribuição/logistica_distribuicao.php'">Logística e
                Distribuição</button>
        </div>

        <div class="opcao">
            <button class="botao" onclick="window.location.href='/Codigo/Php/Pagina Inicial/Histórico/historico_tabelas.php'">Histórico Tabelas</button>
        </div>
    </div>
 
    <div class="container contato">
        <h2>Informações de Contato</h2>
        <br>
        <p>Email: neylor.henriqueo1@gmail.com</p>
        <p>Cidade: Barão de Cocais 35970-000</p>
        <p>Endereço: R. Valdomiro Silva, 49 - São João Batista</p>
        <p>Número: (31) 998648054</p>
    </div>
</body>

</html>
