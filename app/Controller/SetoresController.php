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

    public function criarSetor(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['setor'])) {
            $errors[] = "Setor é obrigatório.";
        }

        if (!empty($errors)) {
            $result = [
                "success" => false,
                "errors"  => $errors
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
        }

        $data = [
            'setor' => $data['setor'],
        ];

        $modelPadrao = new ModelPadrao();
        $inserido = $modelPadrao->insert('setores', $data);

        if ($inserido) {
            $result = [
                "success" => true,
                "message" => "Subseção atualizada com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar a subseção."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function editarSetor(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório.";
        }
        if (empty($data['setor'])) {
            $errors[] = "Setor é obrigatório.";
        }

        if (!empty($errors)) {
            $result = [
                "success" => false,
                "errors"  => $errors
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
        }

        $updateData = [
            'setor' => $data['setor'],
        ];

        $id = intval($data['id']);

        $modelPadrao = new ModelPadrao();
        $atualizou = $modelPadrao->update('setores', $updateData, "id = {$id}");

        if ($atualizou) {
            $result = [
                "success" => true,
                "message" => "Setor atualizada com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar a setor."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function excluirSetor(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório para excluir o setor.";
        }

        if (!empty($errors)) {
            $result = [
                "success" => false,
                "errors"  => $errors
            ];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
        }

        $id = intval($data['id']);

        $modelPadrao = new ModelPadrao();
        $deleted = $modelPadrao->delete('setores', "id = {$id}");

        if ($deleted) {
            $result = [
                "success" => true,
                "message" => "Subseção excluída com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao excluir a subseção."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
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