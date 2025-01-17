<?php

session_start();

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

foreach ($_ENV as $key => $value) {
    define(strtoupper($key), $value);
}

// (require __DIR__ . '/../config/bootstrap.php')->run();

//Build DI container instance
$container = (new ContainerBuilder())
                ->addDefinitions(__DIR__ . '/../app/container.php')
                ->build();

$container->get(App::class)->run();