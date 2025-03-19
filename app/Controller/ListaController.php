<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Model\ListaModel;

use App\Model\Conexao;

class ListaController extends Controller {

    public function listarCastanheira(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_castanheira.html');
    }

    /**
     * return @var ListaModel[]
    */
    public function listaDeCastanheira(Request $request, Response $response)
    {
        $listaDeCastanheira = new ListaModel('lista_castanheira');

        $response->getBody()->write(json_encode($listaDeCastanheira->listarTodos()));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function listarImbauba(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_imbauba.html');
    }

    /**
     * return @var ListaModel[]
    */
    public function listaDeImbauba(Request $request, Response $response)
    {
        $listaDeImbauba = new ListaModel('lista_imbauba');

        $response->getBody()->write(json_encode($listaDeImbauba->listarTodos()));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function listarPauBrasil(Request $request, Response $response)
    {
        return $this->view->render($response, 'listar_paubrasil.html');
    }

    /**
     * return @var ListaModel[]
    */
    public function listaDePauBrasil(Request $request, Response $response)
    {
        $listaDePauBrasil = new ListaModel('lista_pau_brasil');

        $response->getBody()->write(json_encode($listaDePauBrasil->listarTodos()));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}