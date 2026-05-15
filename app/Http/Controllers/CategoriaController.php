<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Services\CategoriaService;
use App\Http\Requests\StoreCategoriaRequest;

class CategoriaController extends Controller
{
    // Injetando o serviço de categoria no controlador
    protected $categoriaService;
    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }
    
    public function index()
    {
         // Obtém todas as categorias do banco de dados
        $categorias = $this->categoriaService->listarCategorias();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    // Utilizando o StoreCategoriaRequest para validar os dados de entrada
    public function store(Request $request)
    {
        dd($request->valited());
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
