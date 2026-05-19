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
    
    // Criando o método edit para exibir o formulário de edição de repertório
    public function edit(Repertorio $repertorio)
    {
        $musicas = Musica::all();
        return view('repertorios.edit', compact('repertorio', 'musicas'));
    }

    // Criando o método update para atualizar o repertório no banco de dados
    public function update(StoreRepertorioRequest $request, Repertorio $repertorio)
    {
        $repertorio->update([
            'nome' => $request->nome,
            'data' => $request->data,
        ]);

        $repertorio->musicas()->sync($request->musicas);
        return redirect()->route('repertorios.index')->with('success', 'Repertório atualizado com sucesso!');
    }

    // Criando o método destroy para excluir um repertório
    public function destroy(Repertorio $repertorio)
    {
        $repertorio->delete();

        return redirect()->route('repertorios.index')->with('success', 'Repertório excluído com sucesso!');
    }
}
