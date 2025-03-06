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
}