<?php 

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\UploadedFile;

use App\Model\{
    Conexao,
    ModelPadrao
};

class FotosController extends Controller {

    public function salvarFoto(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        // Caminho para salvar as fotos
        $diretorio = __DIR__ . '/../../fotos';

        $foto = new ModelPadrao;

        $foto->data             = (isset($data['data']) && $data['data'] !== '') ? $data['data'] : date('Y-m-d');
        $foto->id_setor         = isset($data['setor']) && $data['setor'] !== '' ? (int)$data['setor'] : null;
        $foto->id_subsecao      = isset($data['subsecao']) && $data['subsecao'] !== '' ? (int)$data['subsecao'] : null;
        $foto->id_local         = isset($data['local']) && $data['local'] !== '' ? (int)$data['local'] : null;
        $foto->id_ocorrencia    = isset($data['ocorrencia']) && $data['ocorrencia'] !== '' ? (int)$data['ocorrencia'] : null;
        $foto->observacao       = isset($data['observacao']) && $data['observacao'] !== '' ? $data['observacao'] : 'Sem observações';
        $foto->conforme         = isset($data['conforme']) && $data['conforme'] !== '' ? $data['conforme'] : 'N';
        $foto->lcastanheira     = isset($data['castanheira']) && $data['castanheira'] !== '' ? (int)$data['castanheira'] : null;
        $foto->limbauba         = isset($data['imbauba']) && $data['imbauba'] !== '' ? (int)$data['imbauba'] : null;
        $foto->lpaubrasil       = isset($data['paubrasil']) && $data['paubrasil'] !== '' ? (int)$data['paubrasil'] : null;
        $foto->id_campo_atuacao = isset($data['campo_atuacao']) && $data['campo_atuacao'] !== '' ? (int)$data['campo_atuacao'] : null;
        $foto->usuario          = $data['usuario'] ?? 4;

        // Obtém os arquivos enviados via upload
        $fotos = $request->getUploadedFiles();
        $uploadedFile = $fotos['imagem'] ?? null;

        if ($uploadedFile && $uploadedFile->getError() === UPLOAD_ERR_OK) {
            try {
                // Gera um nome único para o arquivo
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                $basename = bin2hex(random_bytes(8));
                $filename = sprintf('%s.%0.8s', $basename, $extension);

                $foto->nome_arquivo = $filename;
                
                // Insere a foto no banco de dados
                $foto->insert('fotos');

                // Move o arquivo para o diretório de destino
                $uploadedFile->moveTo($diretorio . DIRECTORY_SEPARATOR . $filename);

                // Retorna uma mensagem de sucesso
                $response->getBody()->write(json_encode(['status' => 'success', 'filename' => $filename]));
                return $response->withHeader('Content-Type', 'application/json')
                                ->withStatus(201); // Created
            } catch (\Exception $e) {
                // Captura erros da Model e retorna uma resposta de erro
                $response->getBody()->write(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
                return $response->withHeader('Content-Type', 'application/json')
                                ->withStatus(500); // Internal Server Error
            }
        } else {
            // Retorna uma mensagem de erro para upload
            $response->getBody()->write(json_encode(['status' => 'error', 'message' => 'Erro ao fazer upload']));
            return $response->withHeader('Content-Type', 'application/json')
                            ->withStatus(500); // Internal Server Error
        }
    }

    public function editarFoto(Request $request, Response $response)
    {
        $id = $request->getParsedBody()['id'];

        $foto = (new ModelPadrao)->select('fotos.*, setores.setor, subsecoes.subsecao, local.local, ocorrencia.ocorrencia, campo_atuacao.descricao')
                                ->from('fotos')
                                ->join('LEFT', 'setores', 'setores.id = fotos.id_setor')
                                ->join('LEFT', 'subsecoes', 'subsecoes.id = fotos.id_subsecao')
                                ->join('LEFT', 'local', 'local.id = fotos.id_local')
                                ->join('LEFT', 'ocorrencia', 'ocorrencia.id = fotos.id_ocorrencia')
                                ->join('LEFT', 'campo_atuacao', 'campo_atuacao.id = fotos.id_campo_atuacao')
                                ->where("id_fotos = $id") // Apenas a foto baseado no id
                                ->execute();

        
        // echo "<pre>"; print_r($foto); echo "</pre>"; exit;
        $response->getBody()->write(json_encode($foto));
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function deletarFoto(Request $request, Response $response)
    {
        $response->getBody()->write(json_encode('deletar Foto'));
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function visualizarFotos(Request $request, Response $response)
    {
        // setores
        $setoresOpcoes = (new ModelPadrao)->listAll('setores');
        //subsecoes
        $subsecoesOpcoes = (new ModelPadrao)->listAll('subsecoes');
        //local
        $localOpcoes = (new ModelPadrao)->listAll('local');
        //imbauba
        $imbaubaOpcoes = (new ModelPadrao)->listAll('lista_imbauba');
        //castanheira
        $castanheiraOpcoes = (new ModelPadrao)->listAll('lista_castanheira');
        //pau-brasil
        $pauBrasilOpcoes = (new ModelPadrao)->listAll('lista_pau_brasil');
        //ocorrencias
        $ocorrenciasOpcoes = (new ModelPadrao)->listAll('ocorrencia');
        //campo de atuação
        $campoAtuacaoOpcoes = (new ModelPadrao)->listAll('campo_atuacao');

        return $this->view->render($response, 'visualiza_fotos.html', [
            'setoresOpcoes'      => $setoresOpcoes,
            'subsecoesOpcoes'    => $subsecoesOpcoes,
            'localOpcoes'        => $localOpcoes,
            'imbaubaOpcoes'      => $imbaubaOpcoes,
            'castanheiraOpcoes'  => $castanheiraOpcoes,
            'pauBrasilOpcoes'    => $pauBrasilOpcoes,
            'ocorrenciasOpcoes'  => $ocorrenciasOpcoes,
            'campoAtuacaoOpcoes' => $campoAtuacaoOpcoes,
        ]);
    }

    public function filtrosDasFotos(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $datade         = $data['datade'] ?? null;
        $dataate        = $data['dataate'] ?? null;
        $setor          = $data['setor'] ?? null;
        $subsecao       = $data['subsecao'] ?? null;
        $local          = $data['local'] ?? null;
        $ocorrencia     = $data['ocorrencia'] ?? null;
        $conforme       = $data['conforme'] ?? null;
        $limbauba       = $data['limbauba'] ?? null;
        $lcastanheira   = $data['lcastanheira'] ?? null;
        $lpaubrasil     = $data['lpaubrasil'] ?? null;
        $campo_atuacao  = $data['campo_atuacao'] ?? null;
    
        $filtros = [];
        if ($datade && $dataate) $filtros[] = "data BETWEEN '$datade' AND '$dataate'";
        if ($setor) $filtros[] = "id_setor = '$setor'";
        if ($subsecao) $filtros[] = "id_subsecao = '$subsecao'";
        if ($local) $filtros[] = "id_local = '$local'";
        if ($ocorrencia) $filtros[] = "id_ocorrencia = '$ocorrencia'";
        if ($conforme) $filtros[] = "conforme = '$conforme'";
        if ($limbauba) $filtros[] = "limbauba = '$limbauba'";
        if ($lcastanheira) $filtros[] = "lcastanheira = '$lcastanheira'";
        if ($lpaubrasil) $filtros[] = "lpaubrasil = '$lpaubrasil'";
        if ($campo_atuacao) $filtros[] = "id_campo_atuacao = '$campo_atuacao'";
    
        $whereClause = !empty($filtros) ? implode(' AND ', $filtros) : '';

        $fotos = (new ModelPadrao)->select('nome_arquivo, setor, subsecao, local, ocorrencia, data, conforme,
                        lista_castanheira.item AS item_cast, lista_imbauba.item AS item_imb,
                        lista_pau_brasil.item AS item_pau, observacao, campo_atuacao.descricao AS campo_atuacao')
                        ->from('fotos')
                        ->join('LEFT', 'setores', 'setores.id = fotos.id_setor')
                        ->join('LEFT', 'subsecoes', 'subsecoes.id = fotos.id_subsecao')
                        ->join('LEFT', 'local', 'local.id = fotos.id_local')
                        ->join('LEFT', 'ocorrencia', 'ocorrencia.id = fotos.id_ocorrencia')
                        ->join('LEFT', 'lista_castanheira', 'lcastanheira = lista_castanheira.id')
                        ->join('LEFT', 'lista_imbauba', 'limbauba = lista_imbauba.id')
                        ->join('LEFT', 'lista_pau_brasil', 'lpaubrasil = lista_pau_brasil.id')
                        ->join('LEFT', 'campo_atuacao', 'campo_atuacao.id = fotos.id_campo_atuacao');

        if (!empty($filtros)) {
            $fotos->where($whereClause);
        }
        
        $fotos = $fotos->execute();
    
        $response->getBody()->write(json_encode($fotos));
        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function registrarFotos(Request $request, Response $response)
    {
        // setores
        $setoresOpcoes = (new ModelPadrao)->listAll('setores');
        //subsecoes
        $subsecoesOpcoes = (new ModelPadrao)->listAll('subsecoes');
        //local
        $localOpcoes = (new ModelPadrao)->listAll('local');
        //imbauba
        $imbaubaOpcoes = (new ModelPadrao)->listAll('lista_imbauba');
        //castanheira
        $castanheiraOpcoes = (new ModelPadrao)->listAll('lista_castanheira');
        //pau-brasil
        $pauBrasilOpcoes = (new ModelPadrao)->listAll('lista_pau_brasil');
        //ocorrencias
        $ocorrenciasOpcoes = (new ModelPadrao)->listAll('ocorrencia');
        //campo de atuação
        $campoAtuacaoOpcoes = (new ModelPadrao)->listAll('campo_atuacao');

        // [id_fotos] => 32
        //     [nome_arquivo] => 9dfa6c613983eed6.png
        //     [data] => 2024-11-23
        //     [id_setor] => 
        //     [id_subsecao] => 
        //     [id_local] => 8
        //     [id_ocorrencia] => 
        //     [observacao] => teste
        //     [conforme] => S
        //     [lcastanheira] => 
        //     [limbauba] => 
        //     [lpaubrasil] => 
        //     [id_campo_atuacao] => 1
        //     [usuario] => 4

        //lista de fotos
        $fotos = (new ModelPadrao)->listAll('fotos');

        return $this->view->render($response, 'registrar_fotos.html',
        [
            'fotos'              => $fotos,
            'setoresOpcoes'      => $setoresOpcoes,
            'subsecoesOpcoes'    => $subsecoesOpcoes,
            'localOpcoes'        => $localOpcoes,
            'imbaubaOpcoes'      => $imbaubaOpcoes,
            'castanheiraOpcoes'  => $castanheiraOpcoes,
            'pauBrasilOpcoes'    => $pauBrasilOpcoes,
            'ocorrenciasOpcoes'  => $ocorrenciasOpcoes,
            'campoAtuacaoOpcoes' => $campoAtuacaoOpcoes,
        ]);
    }
}