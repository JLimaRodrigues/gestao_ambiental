<?php

namespace App\Services;

use App\Model\ListaModel;

class ListaPauBrasilService
{
    private $model;

    public function __construct()
    {
        $this->model = new ListaModel('lista_pau_brasil');
    }

    public function listarTodos()
    {
        return $this->model->listarTodos();
    }

    public function buscarPorId($id)
    {
        return $this->model->buscarPorId($id);
    }

    public function buscarPorItem($item)
    {
        return $this->model->buscarPorItem($item);
    }
}
