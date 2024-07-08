<?php
session_start();
require 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: painel.php?error=missing_turma_id");
    exit();
}

$turma_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM atividades WHERE class_id = ?");
$stmt->execute([$turma_id]);
$numAtividades = $stmt->fetchColumn();

if ($numAtividades > 0) {
    $_SESSION['error_message'] = "Você não pode excluir uma turma com atividades cadastradas.";
    header("Location: painel.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM turmas WHERE id = ?");
$stmt->execute([$turma_id]);

$_SESSION['success_message'] = "Turma excluída com sucesso!";
header("Location: painel.php");
exit();
