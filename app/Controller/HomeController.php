<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Model\Conexao;

class HomeController extends Controller {

    public function inicio(Request $request, Response $response)
    {
        return $this->view->render($response, 'inicio.html');
    }
}