@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col gap-4 rounded-[2rem] bg-white p-6 shadow-[0_20px_80px_rgba(15,23,42,0.12)] card-panel sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">Usuários</h1>
            <p class="mt-2 text-sm text-slate-600">Gerencie contas, funções e acesso ao sistema.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Criar usuário</a>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white p-6 shadow-[0_20px_80px_rgba(15,23,42,0.12)] card-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Função</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($users as $user)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 capitalize">{{ $user->role }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium space-x-3">
                                <a href="{{ route('users.edit', $user) }}" class="text-[var(--site-primary)] hover:text-[var(--site-accent)]">Editar</a>
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $users->links() }}</div>
    </div>
</div>
@endsection
