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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('musicas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMusicaRequest $request)
    {
        $this->musicaService->criarMusica($request->validated());
        return redirect()->route('musicas.index')->with('success', 'Música criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Musica $musica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musica $musica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Musica $musica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musica $musica)
    {
        //
    }
}
