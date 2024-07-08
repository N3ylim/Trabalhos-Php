<?php
require_once(__DIR__.'/login.php');

$view->loadFile(__DIR__.'/_view/lista.html',false);
$flow['list'] = produto_list($_SESSION);
$view->foreachData($flow,false);
echo $view->saveText(true,false);
?>