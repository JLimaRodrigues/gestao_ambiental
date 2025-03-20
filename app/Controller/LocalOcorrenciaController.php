<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\UploadedFile;

use App\Model\{
    Conexao,
    ModelPadrao
};

class LocalOcorrenciaController extends Controller {

    public function localOcorrencia(Request $request, Response $response)
    {
        return $this->view->render($response, 'local_ocorrencia.html');
    }

    /**
     * return @var Local[]
    */
    public function listaDeLocal(Request $request, Response $response)
    {
        $modelPadrao = new ModelPadrao();

        $response->getBody()->write(json_encode($modelPadrao->listAll('local')));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    /**
     * return @var Ocorrencia[]
    */
    public function listaDeOcorrencia(Request $request, Response $response)
    {
        $modelPadrao = new ModelPadrao();

        $response->getBody()->write(json_encode($modelPadrao->listAll('ocorrencia')));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}