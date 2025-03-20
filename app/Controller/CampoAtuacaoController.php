<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\UploadedFile;

use App\Model\{
    Conexao,
    ModelPadrao
};

class CampoAtuacaoController extends Controller {

    public function campoAtuacao(Request $request, Response $response)
    {
        
        return $this->view->render($response, 'campo_atuacao.html');
    }

    /**
     * return @var CampoAtuacao[]
    */
    public function listaDeCampoAtuacao(Request $request, Response $response)
    {
        $modelPadrao = new ModelPadrao();

        $response->getBody()->write(json_encode($modelPadrao->listAll('campo_atuacao')));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}