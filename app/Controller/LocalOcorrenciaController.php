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
        return $this->view->render($response, 'local_ocorrencia/local_ocorrencia.html');
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

    public function criarLocal(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['local'])) {
            $errors[] = "Local é obrigatório.";
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
            'local' => $data['local'],
        ];

        $modelPadrao = new ModelPadrao();
        $inserido = $modelPadrao->insert('local', $data);

        if ($inserido) {
            $result = [
                "success" => true,
                "message" => "Local atualizada com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar a local."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function editarLocal(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório.";
        }
        if (empty($data['local'])) {
            $errors[] = "Local é obrigatório.";
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
            'local' => $data['local'],
        ];

        $id = intval($data['id']);

        $modelPadrao = new ModelPadrao();
        $atualizou = $modelPadrao->update('local', $updateData, "id = {$id}");

        if ($atualizou) {
            $result = [
                "success" => true,
                "message" => "Local atualizado com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar o local."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function excluirLocal(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório para excluir o local.";
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
        $deleted = $modelPadrao->delete('local', "id = {$id}");

        if ($deleted) {
            $result = [
                "success" => true,
                "message" => "Local excluído com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao excluir o local."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
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

    public function criarOcorrencia(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['ocorrencia'])) {
            $errors[] = "Ocorrência é obrigatório.";
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
            'ocorrencia' => $data['ocorrencia'],
        ];

        $modelPadrao = new ModelPadrao();
        $inserido = $modelPadrao->insert('ocorrencia', $data);

        if ($inserido) {
            $result = [
                "success" => true,
                "message" => "Ocorrência atualizada com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar a ocorrência."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function editarOcorrencia(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório.";
        }
        if (empty($data['ocorrencia'])) {
            $errors[] = "Ocorrência é obrigatório.";
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
            'ocorrencia' => $data['ocorrencia'],
        ];

        $id = intval($data['id']);

        $modelPadrao = new ModelPadrao();
        $atualizou = $modelPadrao->update('ocorrencia', $updateData, "id = {$id}");

        if ($atualizou) {
            $result = [
                "success" => true,
                "message" => "Ocorrência atualizado com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao atualizar o ocorrência."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function excluirOcorrencia(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (empty($data['id'])) {
            $errors[] = "ID é obrigatório para excluir a ocorrência.";
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
        $deleted = $modelPadrao->delete('ocorrencia', "id = {$id}");

        if ($deleted) {
            $result = [
                "success" => true,
                "message" => "Ocorrência excluído com sucesso!"
            ];
        } else {
            $result = [
                "success" => false,
                "message" => "Falha ao excluir o ocorrência."
            ];
        }

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
        
    }
}