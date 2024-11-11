<?php
// Inicia a sessão se não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    if ($_SERVER['REQUEST_URI'] !== '/login/login.php') {
        header("Location: /login/login.php");
        exit;
    }
}

// Configurações de fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Exibição de erros para desenvolvimento (ajuste conforme necessário para produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuração de localidade
setlocale(LC_ALL, 'pt_BR.utf8');

// Inclui arquivos necessários
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/global_constraints.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/includes.php';
require_once HOME_DIR . 'includes/funcoes.php';

// Configura o charset padrão
ini_set('default_charset', 'utf-8');
