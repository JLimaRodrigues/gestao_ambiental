<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/autoload.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["status" => "false", "message" => "Usuário não autenticado."]);
    exit;
}

if (isset($_GET['foto'])) {
    $foto = basename($_GET['foto']);
    $caminhoCompleto = $_SERVER['DOCUMENT_ROOT'] . "/armazenamento/$foto";

    if (file_exists($caminhoCompleto)) {
        header('Content-Type: image/jpeg');
        readfile($caminhoCompleto);
        exit;
    } else {
        http_response_code(404);
        echo "Imagem não encontrada.";
        exit;
    }
}
