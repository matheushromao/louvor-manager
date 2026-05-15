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

    // Método Create para criar uma nova categoria
    public function criarCategoria(array $dados)
    {
        return Categoria::create($dados);
    }

    // Método Update para atualizar uma categoria existente
    public function atualizarCategoria(Categoria $categoria, array $dados)
    {
        return $categoria->update($dados);
    }

     // Método Delete para deletar uma categoria
     public function deletarCategoria(Categoria $categoria)
     {
         return $categoria->delete();
     }
}