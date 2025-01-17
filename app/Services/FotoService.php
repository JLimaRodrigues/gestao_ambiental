<?php

namespace App\Services;

use App\Models\FotoModel;

class FotoService {
    private $fotoModel;

    public function __construct() {
        $this->fotoModel = new FotoModel();
    }

    public function listarFotos()
    {
        return $this->fotoModel->listarTodos();
    }

}