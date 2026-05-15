<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Services\MusicaService;
use App\Http\Requests\StoreMusicaRequest;

class MusicaController extends Controller
{
    protected $musicaService;
    public function __construct(MusicaService $musicaService)
    {
        $this->musicaService = $musicaService;
    }
    public function index()
    {
        $musicas = $this->musicaService->listarMusicas();
        return view('musicas.index', compact('musicas'));
    }

    // Formulário para criar uma nova música
    public function create()
    {
        $categorias = Categoria::all();
        return view('musicas.create', compact('categorias'));
    }

    // Armazenar uma nova música
    public function store(StoreMusicaRequest $request)
    {
        $this->musicaService->criarMusica($request->validated());
        return redirect()->route('musicas.index')->with('success', 'Música criada com sucesso!');
    }

    // Formulário para editar uma música existente
    public function edit(Musica $musica)
    {
        $categorias = Categoria::all();

        return view('musicas.edit', compact('musica', 'categorias'));
    }

    // Atualizar uma música existente
    public function update(StoreMusicaRequest $request, Musica $musica)
    {
       $this->musicaService->atualizarMusica($musica, $request->validated());
       return redirect()->route('musicas.index')->with('success', 'Música atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musica $musica)
    {
        $this->musicaService->deletarMusica($musica);
        return redirect()->route('musicas.index')->with('success', 'Música deletada com sucesso!');
    }
}
