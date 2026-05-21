@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_80px_rgba(15,23,42,0.12)] card-panel">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-slate-900">Editar usuário</h1>
            <p class="mt-2 text-sm text-slate-600">Atualize o perfil, a role ou a senha do usuário.</p>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-label for="name" value="Nome" />
                <x-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-label for="role" value="Função" />
                <select id="role" name="role" class="mt-1 block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 text-sm text-slate-900 focus:border-[var(--site-primary)] focus:ring focus:ring-[var(--site-primary)]/20">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <x-label for="password" value="Nova senha (opcional)" />
                    <x-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-label for="password_confirmation" value="Confirmar nova senha" />
                    <x-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Salvar alterações</button>
                <a href="{{ route('users.index') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
