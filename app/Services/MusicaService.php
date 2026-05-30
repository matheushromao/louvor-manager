<?php 

namespace App\Services;

use App\Models\Musica;

class MusicaService{

    // Método para listar músicas com a categoria associada, aplicando
    // pesquisa por título, filtro por categoria e ordenação alfabética.
    public function listarMusicas(array $filtros = [])
    {
        $query = Musica::with('categoria');

        // Pesquisa parcial por título, ignorando maiúsculas/minúsculas.
        if (!empty($filtros['busca'])) {
            $termo = mb_strtolower(trim($filtros['busca']));
            $query->whereRaw('LOWER(titulo) LIKE ?', ['%' . $termo . '%']);
        }

        // Filtro por categoria.
        if (!empty($filtros['categoria_id'])) {
            $query->where('categoria_id', $filtros['categoria_id']);
        }

        // Ordenação alfabética crescente direto na consulta, com paginação
        // que preserva os parâmetros de busca/filtro nos links.
        return $query
            ->orderBy('titulo')
            ->paginate(10)
            ->withQueryString();
    }

    // Método para criar uma nova música
    public function criarMusica(array $dados)
    {
        return Musica::create($dados);
    }

    // Método para atualizar uma música existente
    public function atualizarMusica(Musica $musica, array $dados): bool
    {
        return $musica->update($dados);
    }

     // Método Delete para deletar uma música
     public function deletarMusica(Musica $musica): bool
     {
         return $musica->delete();
     }
}