<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/global_constraints.php';

    header('Content-Type: text/html; charset=UTF-8');
    ini_set('default_charset', 'utf-8');
    setlocale(LC_ALL, 'pt_BR.utf8');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    date_default_timezone_set('America/Sao_Paulo');

    ini_set('session.gc_maxlifetime', 10800);

    require_once $_SERVER['DOCUMENT_ROOT'] . "/config/includes.php";

    require_once HOME_DIR . 'componentes/navbar.php';
    require_once HOME_DIR . 'includes/funcoes.php';

    ?>

</body>

</html>