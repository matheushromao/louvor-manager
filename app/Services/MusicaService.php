<?php 

namespace App\Services;

use App\Models\Musica;

class MusicaService{

    // Método para listar todas as músicas com a categoria associada
    public function listarMusicas()
    {
        return Musica::with('categoria')->paginate(5);
    }

    // Método para criar uma nova música
    public function criarMusica(array $dados)
    {
        return Musica::create($dados);
    }
}