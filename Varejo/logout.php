<?php
require_once(__DIR__ . '/login.php');

if ($_POST) {
   $_SESSION = array();
   header('location: ./login.php');
   exit;
}

$view->loadFile(__DIR__ . '/_view/logout.html', false);
$view->foreachData($_SESSION, false);
echo $view->saveText(true, false);
