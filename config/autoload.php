<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    if ($_SERVER['REQUEST_URI'] !== '/login/login.php') {
        header("Location: /login/login.php");
        exit;
    }
}

date_default_timezone_set('America/Sao_Paulo');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

setlocale(LC_ALL, 'pt_BR.utf8');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/global_constraints.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/includes.php';
require_once HOME_DIR . 'includes/funcoes.php';

ini_set('default_charset', 'utf-8');
