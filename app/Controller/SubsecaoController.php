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

    public function editarSubsecao(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório.";
        }
        if (empty($data['subsecao'])) {
            $errors[] = "Subseção é obrigatória.";
        }
        if (empty($data['setor_superior'])) {
            $errors[] = "Setor Superior é obrigatório.";
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
            'subsecao'       => $data['subsecao'],
            'setor_superior' => intval($data['setor_superior']),
        ];

        $id = intval($data['id']);

        $modelPadrao = new ModelPadrao();
        $atualizou = $modelPadrao->update('subsecoes', $updateData, "id = {$id}");

        if ($atualizou) {
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

    public function excluirSubsecao(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório para excluir a subseção.";
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
        $deleted = $modelPadrao->delete('subsecoes', "id = {$id}");

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