@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-3xl">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Criar novo usuário</h1>
        <p class="text-sm text-gray-500">Os campos abaixo são necessários para criar uma conta no sistema.</p>
    </div>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <x-label for="name" value="Nome" />
            <x-input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-1 block w-full" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-label for="email" value="Email" />
            <x-input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-label for="role" value="Função" />
            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($roles as $role)
                <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-label for="password" value="Senha" />
            <x-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-label for="password_confirmation" value="Confirmar senha" />
            <x-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-3">
            <x-button type="submit">Salvar usuário</x-button>
            <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
        </div>
    </form>
</div>
@endsection