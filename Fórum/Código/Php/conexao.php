<?php
$host = 'localhost'; // Nome do servidor MySQL
$usuario = 'root'; // Usuário do MySQL
$senha = ''; // Senha do MySQL
$banco = 'forum'; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Define o charset para UTF-8 (opcional)
$conn->set_charset("utf8");
?>
