<?php
require_once(__DIR__.'/resources/fmac/autoload.php');
setDebug(true);

require_once(__DIR__.'/_model.php');
use FMAC\MVC\TView;

session_start();
$view = new TView();
$flow = array();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['senha'])) {
    $view->loadFile(__DIR__.'/_view/login.html', false);
    if (isset($_POST['nome'], $_POST['senha'])) {
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
    $view->foreachData($flow, false);
    echo $view->saveText(true, false);
    exit;
}
?>
