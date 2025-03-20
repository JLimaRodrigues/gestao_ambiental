<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\UploadedFile;

use App\Model\{
    Conexao,
    ModelPadrao
};

class SetoresController extends Controller {

    public function setores(Request $request, Response $response)
    {
        return $this->view->render($response, 'setores.html');
    }

    /**
     * return @var Setores[]
    */
    public function listaDeSetores(Request $request, Response $response)
    {
        $modelPadrao = new ModelPadrao();

        $response->getBody()->write(json_encode($modelPadrao->listAll('setores')));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}