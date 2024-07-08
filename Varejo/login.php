<?php
require_once(__DIR__ . '/resources/fmac/autoload.php');
require_once(__DIR__ . '/_model.php');

use FMAC\MVC\TView;
$view = new TView();
$flow = array();
session_start();

if (!issets($_SESSION, 'id', 'nome', 'senha')) {
   if (issets($_POST, 'nome', 'senha')) {
      if ($_SESSION = usuario_select($_POST)) {
         header('location: ./lista.php');
         exit;
      } else {
         $flow = $_POST;
         $flow['erro'] = true;
      }
   } else {
      $flow['nome'] = '';
      $flow['senha'] = '';
      $flow['erro'] = false;
   }
   $view->loadFile(__DIR__ . '/_view/login.html', false);
   $view->foreachData($flow, false);
   echo $view->saveText(true, false);
   exit;
}
