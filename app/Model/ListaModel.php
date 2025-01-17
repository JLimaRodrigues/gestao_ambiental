<?php

namespace App\Model;

class ListaModel extends ModelPadrao 
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

    public function buscarPorId($id)
    {
        return $this->find($id, $this->tabela, 'id_fotos');
    }

    public function buscarPorItem($item)
    {
        return $this->select('*')
                    ->from($this->tabela)
                    ->where("item = '{$item}'")
                    ->execute();
    }

    public function buscarPorDesc($desc)
    {
        return $this->select('*')
                    ->from($this->tabela)
                    ->where("desc_item = '{$desc}' OR descricao = '{$desc}'")
                    ->execute();
    }
}
