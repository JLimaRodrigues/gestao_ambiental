<?php 

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

use App\Controller\{
    LoginController,
    FotosController,
    HomeController,
    CampoAtuacaoController,
    LocalOcorrenciaController,
    SetoresController,
    SubsecaoController
    };

use Slim\Routing\RouteContext;

return function (App $app) {
    $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('login');

        return $response->withHeader('Location', $url)
                            ->withStatus(302);
    });

    //rotas de autenticação
    $app->get('/login', [LoginController::class, 'login'])->setName('login');
    $app->post('/logar', [LoginController::class, 'logar'])->setName('logar');
    $app->get('/logout', [LoginController::class, 'logout'])->setName('logout');

    $app->group('/admin', function ($group) {
         //rotas de home
        $group->get('/inicio', [HomeController::class, 'inicio'])->setName('inicio');

        //rotas de fotos
        $group->post('/salvarFoto', [FotosController::class, 'salvarFoto'])->setName('salvarFoto');
        $group->post('/editarFoto', [FotosController::class, 'editarFoto'])->setName('editarFoto');
        $group->post('/deletarFoto', [FotosController::class, 'deletarFoto'])->setName('deletarFoto');

        $group->get('/visualizarFotos', [FotosController::class, 'visualizarFotos'])->setName('visualizarFotos');
        $group->post('/fotos/filtros', [FotosController::class, 'filtrosDasFotos'])->setName('filtrosDasFotos');
        $group->get('/registrarFotos', [FotosController::class, 'registrarFotos'])->setName('registrarFotos');

        //rotas de campo atuação
        $group->get('/campoAtuacao', [CampoAtuacaoController::class, 'campoAtuacao'])->setName('campoAtuacao');

        //rotas de Local/Ocorrencia
        $group->get('/localOcorrencia', [LocalOcorrenciaController::class, 'localOcorrencia'])->setName('localOcorrencia');

        //rotas de setores
        $group->get('/setores', [SetoresController::class, 'setores'])->setName('setores');

        //rotas de subsecao
        $group->get('/subsecao', [SubSecaoController::class, 'subsecao'])->setName('subsecao');


    })->add('authMiddleware');
};