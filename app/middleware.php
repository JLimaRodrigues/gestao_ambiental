<?php

use Slim\App;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    $app->add(
        function ($request, $next) {
            if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
                session_start();
            }
            $this->get('flash')->__construct($_SESSION);
            return $next->handle($request);
        }
    );

    // Handle exceptions
    $app->addErrorMiddleware(true, true, true);
};