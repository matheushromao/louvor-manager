<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private readonly UserService $users)
    {
    }

    public function index(): View
    {
        return view('users.index', [
            'users' => $this->users->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'roles' => User::roles(),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->users->create($request->validated());

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => User::roles(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->users->update($user, $request->validated());

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        // Regra de segurança: um administrador não pode excluir a si mesmo.
        if ($request->user()->cannot('delete', $user)) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir o seu próprio usuário.');
        }

        $this->users->delete($user);

        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso.');
    }
}
