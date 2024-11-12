<?php
// Inicia a sessão
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/autoload.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    echo json_encode(["status" => "false", "message" => "Usuário não autenticado."]);
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/global_constraints.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/includes.php";
require_once HOME_DIR . 'componentes/navbar.php';
require_once HOME_DIR . 'includes/funcoes.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Ambiental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-foto {
            max-width: 800px;
            margin: auto;
            text-align: center;
        }

        .header-text {
            margin-top: 60px;
            color: #3b3f42;
        }

        .description-text {
            color: #555;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .foto {
            max-width: 100%;
            height: auto;
        }

        footer {
            background-color: #f8f9fa;
            padding: 1em;
            text-align: center;
            width: 100%;
        }

        .nav-link,
        .navbar-brand {
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .navbar-brand:hover {
            color: #a3da22;
        }

        .dropdown-menu {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .dropdown-menu.show {
            transform: translateY(0);
            opacity: 1;
            border-bottom: 5px solid #a3da22;
        }

        .dropdown-item.selected {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="header-text">Sistema de Gestão Ambiental</h1>
        <p class="description-text">Sistema desenvolvido para o envio e visualização de fotos, permitindo o acompanhamento detalhado do progresso das atividades do departamento de meio ambiente.</p>
    </div>

    <div class="container-foto image-container">
        <img src="/includes/capa.jpg" alt="Capa do sistema" class="img-fluid foto">
    </div>

    <footer class="container text-center">
        Desenvolvido por: Douglas Marcondes.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>