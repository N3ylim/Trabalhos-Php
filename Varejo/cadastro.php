<?php
require_once(__DIR__.'/resources/fmac/autoload.php');
require_once(__DIR__.'/_model.php');
use FMAC\MVC\TView;
$view = new TView();
$flow = array();

if (issets($_POST,'nome','senha') and usuario_insert($_POST))
{
    header('location: ./index.php');
    exit;
} else {
    $flow['nome'] = '';
    $flow['senha'] = '';
}

$view->loadFile(__DIR__ . '/_view/cadastro.html', false);
$view->foreachData($flow,false);
echo $view ->saveText(true,false);
?>