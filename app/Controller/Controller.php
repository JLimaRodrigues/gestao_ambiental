<?php 

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Flash\Messages;

abstract class Controller {
    protected Twig $view;
    protected LoggerInterface $logger;
    protected RouteParserInterface $router;
    protected $flash;

    public function __construct(ContainerInterface $container) {
        $this->view     = $container->get('view');
        $this->logger   = $container->get('logger');
        $this->router   = $container->get('router');
        $this->flash    = $container->get('flash');
    }
}