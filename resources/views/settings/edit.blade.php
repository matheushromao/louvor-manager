@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl">

    <div class="mb-6">
        <h1 class="text-2xl font-bold">Configurações do Sistema</h1>
        <p class="mt-2 text-sm text-gray-500">Edite as informações do site que aparecem no cabeçalho e no rodapé.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 rounded border border-green-300 bg-green-50 p-4 text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <x-label for="site_name" value="Nome do Sistema" />
            <x-input id="site_name" name="site_name" type="text" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
        </div>

        <div>
            <x-label for="church_name" value="Nome da Igreja" />
            <x-input id="church_name" name="church_name" type="text" value="{{ old('church_name', $settings['church_name'] ?? '') }}" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('church_name')" class="mt-2" />
        </div>

        <div>
            <x-label for="footer_text" value="Texto do Rodapé" />
            <x-input id="footer_text" name="footer_text" type="text" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('footer_text')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3">
            <x-button type="submit">Salvar Configurações</x-button>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Voltar</a>
        </div>
    </form>

</div>

@endsection