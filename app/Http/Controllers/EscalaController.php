<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEscalaRequest;
use App\Models\Escala;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EscalaController extends Controller
{
    /**
     * Lista as escalas. Acessível a qualquer usuário autenticado.
     */
    public function index(): View
    {
        $escalas = Escala::with('usuarios')->orderByDesc('data')->paginate(10);

        return view('escalas.index', compact('escalas'));
    }

    /**
     * Formulário de criação. Restrito a admin/vocal pela rota.
     */
    public function create(): View
    {
        return view('escalas.create', [
            'vocais' => $this->vocais(),
        ]);
    }

    /**
     * Persiste uma nova escala e vincula os vocais selecionados.
     */
    public function store(StoreEscalaRequest $request): RedirectResponse
    {
        $escala = Escala::create($request->safe()->only(['data', 'observacao']));

        $escala->usuarios()->sync($request->input('usuarios', []));

        return redirect()->route('escalas.index')->with('success', 'Escala criada com sucesso!');
    }

    /**
     * Exibe uma escala. Acessível a qualquer usuário autenticado.
     */
    public function show(Escala $escala): View
    {
        $escala->load('usuarios');

        return view('escalas.show', compact('escala'));
    }

    /**
     * Formulário de edição. Restrito a admin/vocal pela rota.
     */
    public function edit(Escala $escala): View
    {
        return view('escalas.edit', [
            'escala' => $escala->load('usuarios'),
            'vocais' => $this->vocais(),
        ]);
    }

    /**
     * Atualiza a escala e sincroniza os vocais.
     */
    public function update(StoreEscalaRequest $request, Escala $escala): RedirectResponse
    {
        $escala->update($request->safe()->only(['data', 'observacao']));

        $escala->usuarios()->sync($request->input('usuarios', []));

        return redirect()->route('escalas.index')->with('success', 'Escala atualizada com sucesso!');
    }

    /**
     * Remove a escala. Restrito a admin/vocal pela rota.
     */
    public function destroy(Escala $escala): RedirectResponse
    {
        $escala->delete();

        return redirect()->route('escalas.index')->with('success', 'Escala excluída com sucesso!');
    }

    /**
     * Usuários habilitados a serem escalados (apenas role vocal).
     */
    private function vocais(): Collection
    {
        return User::where('role', User::ROLE_VOCAL)->orderBy('name')->get();
    }
}
