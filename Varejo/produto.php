<?php
require_once(__DIR__ . '/login.php');

$produto = produto_select(ifset($_GET, 'id', 0));
$flow['usuario_id'] = $_SESSION['id'];
$flow['id'] = ifset($_GET, 'id', 0);
$flow['nome'] = ifset_multi('', 'nome', $_POST, $produto);
$flow['quantidade'] = ifset_multi(0, 'quantidade', $_POST, $produto);
$flow['validade'] = ifset_multi(NULL, 'validade', $_POST, $produto);

if ($_POST AND produto_update($flow)) {
   header('location: ./lista.php');
}

$view->loadFile(__DIR__ . '/_view/produto.html', false);
$view->foreachData($flow, false);
echo $view->saveText(true, false);
?>