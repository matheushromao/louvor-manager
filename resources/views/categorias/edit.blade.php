@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-xl">
    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 sm:p-8 card-panel">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Editar Categoria</h1>
            <p class="mt-1 text-sm text-slate-500">Atualize o nome desta categoria.</p>
        </div>

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <x-label>Nome</x-label>
                <x-input type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" />
                <x-error field="nome" />
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <x-button type="submit">Atualizar</x-button>
                <a href="{{ route('categorias.index') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
