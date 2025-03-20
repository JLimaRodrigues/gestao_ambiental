<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\UploadedFile;

use App\Model\{
    Conexao,
    ModelPadrao
};

class SubsecaoController extends Controller {

    public function subsecao(Request $request, Response $response)
    {
        return $this->view->render($response, 'subsecao.html');
    }

    /**
     * return @var Subsecao[]
    */
    public function listaDeSubsecao(Request $request, Response $response)
    {
        $modelPadrao = new ModelPadrao();

        // $sql = "SELECT subsecoes.*, setores.setor FROM subsecoes INNER JOIN setores on setores.id = subsecoes.setor_superior";

        $dados = $modelPadrao->select('subsecoes.*, setores.setor')
                    ->from('subsecoes')
                    ->join('left', 'setores', 'setores.id = subsecoes.setor_superior')
                    ->execute();


        $response->getBody()->write(json_encode($dados));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}