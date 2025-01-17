<?php 

//estrutura do Slim 4
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

//monolog - Logs
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

//twig-view
use Slim\Views\{Twig, TwigMiddleware};

//flashes Messages
use Slim\Flash\Messages;

//controllers do sistema
use App\Controllers\{ 
    LoginController,
    FotosController,
    HomeController
   };

return [
    'settings' => function () {
        return require __DIR__ . '/../config.php'; 
    },

    App::class => function (ContainerInterface $container) {
        $app = AppFactory::createFromContainer($container);

        //registrar rotas
        (require __DIR__ . '/rotas.php')($app);

        //registrar middleware
        (require __DIR__ . '/middleware.php')($app);

        $app->add(TwigMiddleware::createFromContainer($app, 'view'));

        return $app;
    },

   'view' => function (ContainerInterface $container) {
        
        $twig = Twig::create(__DIR__ . '/View', [
            'cache' => false,
        ]);

        // Recupera o serviço do usuário (UsuarioSessao)
        $usuarioService = $container->get(UsuarioSessao::class);

        // Calcula valores para as variáveis globais
        $autenticado   = $usuarioService->getAutenticado();
        $tempoRestante = $usuarioService->getTempoRestante();
        $login         = $usuarioService->getLogin();

        $environmnent = $twig->getEnvironment();
        $environmnent->addGlobal('flash', $container->get('flash'));
        $environmnent->addGlobal('autenticado', $autenticado);
        $environmnent->addGlobal('tempoRestante', $tempoRestante);
        $environmnent->addGlobal('login', $login);

        return $twig;
    },

    'logger' => function (ContainerInterface $container) {
        // Criação da instância do Logger com o nome 'gestao_ambiental'
        $logger = new Logger('gestao_ambiental');
        
        // Definir o caminho do arquivo de log
        $logDirectory = __DIR__ . '/../log/' . date("Y");
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0777, true);  // Cria o diretório se não existir
        }
        $logPath = $logDirectory . '/log_' . date("Ymd") . '.txt';

        // Criação do StreamHandler para registrar logs no arquivo
        $fileHandler = new StreamHandler($logPath);

        // Configuração do formato do log
        $formatter = new LineFormatter("%datetime% [%level_name%] %message% %context% %extra%\n");
        $formatter->includeStacktraces(true);  // Inclui stack traces nos logs

        // Aplicar o formatter ao handler
        $fileHandler->setFormatter($formatter);
        
        // Adicionar o handler ao logger
        $logger->pushHandler($fileHandler);

        return $logger;
    },

    'router' => function (ContainerInterface $container) {
        
        $app = $container->get(App::class);

        return $app->getRouteCollector()->getRouteParser();
    },

    'flash' => function () {
        $storage = [];
        return new Messages($storage);
    },

    'authMiddleware' => function (ContainerInterface $container) {
        $responseFactory = $container->get(\Slim\App::class)->getResponseFactory();
        $secretKey = SECRET_KEY;
    
        return new \App\Middleware\AuthMiddleware($responseFactory, $secretKey, $container);
    },

    UsuarioSessao::class => function (ContainerInterface $container) {
        return new \App\Services\UsuarioSessao();
    },

    //LoginController
    LoginController::class => function (ContainerInterface $container) {
        return new LoginController($container);
    },

    //FotosController
    FotosController::class => function (ContainerInterface $container) {
        return new FotosController($container);
    },

    //FotosController
    HomeController::class => function (ContainerInterface $container) {
        return new HomeController($container);
    }
];