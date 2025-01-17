<?php

namespace App\Model;

class FotoModel extends ModelPadrao 
{
    private $tabela;

    public function __construct(string $tabela)
    {
        parent::__construct();
        $this->tabela = $tabela;
    }

    public function listarTodos()
    {
        return $this->listAll($this->tabela);
    }

    //busca por id_fotos
    public function buscarPorId($id)
    {
        return $this->find($id, $this->tabela, 'id_fotos');
    }

    public function buscarNomeArquivo($nomeArquivo)
    {
        return $this->select('*')
                    ->from($this->tabela)
                    ->where("nome_arquivo = '{$item}'")
                    ->execute();
    }

}
