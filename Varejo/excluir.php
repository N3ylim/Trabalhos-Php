<?php
require_once(__DIR__ . '/login.php');

if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    if (produto_delete($produto_id)) {
        header('Location: ./lista.php');
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID do produto não especificado.";
}
?>
