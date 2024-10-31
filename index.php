<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/includes/estilo.css" rel="stylesheet">

    <title>Sistema de Gestão Ambiental</title>
</head>

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

<body>


    <div class="container">
        <h1>Sistema de Gestão Ambiental</h1>
        <p>Sistema desenvolvido para o envio e visualização de fotos, permitindo o acompanhamento detalhado do progresso das atividades do departamento de meio ambiente.</p>
    </div>

    <footer>Desenvolvido por: Douglas Marcondes.</footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>