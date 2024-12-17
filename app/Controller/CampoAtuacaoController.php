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

    public function listarCampoAtuacao(Request $request, Response $response)
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
}