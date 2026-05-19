<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepertorioRequest;
use App\Models\Repertorio;
use Illuminate\Http\Request;
use App\Models\Musica;

class RepertorioController extends Controller
{
    // Métodos para o CRUD de repertórios
    public function index()
    {
        $repertorios = Repertorio::with('musicas')->latest()->paginate(10);
        return view('repertorios.index', compact('repertorios'));
    }

    // Criando o método create para exibir o formulário de criação de repertório
    public function create()
    {
        $musicas = Musica::all();
        return view('repertorios.create', compact('musicas'));
    }
    
    // Criando o método store para salvar o novo repertório no banco de dados
    public function store(StoreRepertorioRequest $request)
    {
        $repertorio = Repertorio::create([
            'nome' => $request->nome,
            'data' => $request->data,
        ]);

        $repertorio->musicas()->sync($request->musicas);
        return redirect()->route('repertorios.index')->with('success', 'Repertório criado com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repertorio $repertorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repertorio $repertorio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repertorio $repertorio)
    {
        //
    }
}
