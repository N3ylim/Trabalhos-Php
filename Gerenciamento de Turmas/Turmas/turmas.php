<?php
session_start();

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $stmt = $pdo->prepare("INSERT INTO turmas (professor_id, name) VALUES (?, ?)");
    $stmt->execute([$_SESSION['professor_id'], $name]);

    header("Location: painel.php");
    exit();
}
?>