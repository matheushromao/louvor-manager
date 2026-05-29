@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-2xl">
    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 sm:p-8 card-panel">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Editar Música</h1>
            <p class="mt-1 text-sm text-slate-500">Atualize as informações desta música.</p>
        </div>

        <form action="{{ route('musicas.update', $musica->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <x-label>Título</x-label>
                <x-input type="text" name="titulo" value="{{ old('titulo', $musica->titulo) }}" />
                <x-error field="titulo" />
            </div>

            <div>
                <x-label>Artista</x-label>
                <x-input type="text" name="artista" value="{{ old('artista', $musica->artista) }}" />
                <x-error field="artista" />
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <x-label>Tom</x-label>
                    <x-input type="text" name="tom" value="{{ old('tom', $musica->tom) }}" />
                    <x-error field="tom" />
                </div>

                <div>
                    <x-label>Categoria</x-label>
                    <select
                        name="categoria_id"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-[var(--site-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--site-primary)]/20">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(old('categoria_id', $musica->categoria_id) == $categoria->id)>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                    <x-error field="categoria_id" />
                </div>
            </div>

            <div>
                <x-label>Link do YouTube</x-label>
                <x-input type="url" name="youtube_link" value="{{ old('youtube_link', $musica->youtube_link ?? '') }}" placeholder="https://youtube.com/..." />
                <x-error field="youtube_link" />
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <x-button type="submit">Atualizar</x-button>
                <a href="{{ route('musicas.index') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
