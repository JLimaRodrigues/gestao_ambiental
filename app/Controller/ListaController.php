<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Model\Conexao;

class ListaController extends Controller {

    public function listarCastanheira(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_castanheira.html');
        //echo "Ola mundo dentro do listar Castanheira"; exit;
    }

    public function listarImbauba(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_imbauba.html');
    }

    public function listarPauBrasil(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_paubrasil.html');
    }
}