<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Services\CategoriaService;
use App\Http\Requests\StoreCategoriaRequest;

use function Pest\Laravel\delete;

class CategoriaController extends Controller
{
    // Injetando o serviço de categoria no controlador
    protected $categoriaService;
    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    // Método Index(FindAll) para listar todas as categorias
    public function index()
    {
        $categorias = $this->categoriaService->listarCategorias();
        return view('categorias.index', compact('categorias'));
    }

    // Método Create para exibir o formulário de criação de categoria
    public function create()
    {
        return view('categorias.create');
    }

    // Método Save (store) para criar uma nova categoria
    public function store(StoreCategoriaRequest $request)
    {
        $this->categoriaService->criarCategoria($request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    // Método Edit para exibir o formulário de edição de categoria
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    // método Update para atualizar uma categoria existente
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $this->categoriaService->atualizarCategoria($categoria, $request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $this->categoriaService->deletarCategoria($categoria);
        return redirect()->route('categorias.index')->with('success', 'Categoria deletada com sucesso!');
    }
}
