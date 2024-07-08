<?php
require_once(__DIR__ . '/login.php');
require_once(__DIR__ . '/_model.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$produto = produto_select($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $compra = [
        
        'produto_id' => isset($_POST['id']) ? $_POST['id'] : 0,
        'quantidade' => isset($_POST['quantidade']) ? $_POST['quantidade'] : 0,
        'valor' => isset($_POST['valor']) ? $_POST['valor'] : 0
    ];

    if (registrar_compra($compra)) {
        header('Location: ./lista.php');
        exit;
    } else {
        $erro = "Erro ao realizar a compra.";
    }
}

include(__DIR__ . '/_view/compra.html');
?>
