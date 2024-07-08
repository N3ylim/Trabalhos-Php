<?php
// Inicializa a sessão se ainda não estiver iniciada
session_start();

// Finaliza a sessão (limpa todos os dados da sessão)
session_unset();
session_destroy();

// Redireciona para a página de login após o logout
header('Location: index.php');
exit();
?>
