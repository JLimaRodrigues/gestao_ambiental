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
}