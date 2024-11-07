<?php
// Inicia a sessão
session_start();

// Verifica se a sessão 'usuario' está definida
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    if ($_SERVER['REQUEST_URI'] !== '/login/login.php') {
        // Verifica se a página atual não é a página de login antes de redirecionar
        header("Location: /login/login.php");
        exit;  // Garante que o código não continue sendo executado após o redirecionamento
    }
}

// Definir o fuso horário e outras configurações
date_default_timezone_set('America/Sao_Paulo');

// Configurações de erro
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configurações de localidade
setlocale(LC_ALL, 'pt_BR.utf8');

// Outras inclusões de arquivos necessários
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/global_constraints.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/includes.php';
require_once HOME_DIR . 'includes/funcoes.php';

// Definir o tipo de conteúdo da página
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset', 'utf-8');
?>
