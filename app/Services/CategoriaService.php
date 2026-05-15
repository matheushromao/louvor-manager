<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    // Método findAll para listar todas as categorias
    public function listarCategorias()
    {
        return Categoria::all();
    }
}