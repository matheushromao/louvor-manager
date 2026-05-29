@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-3xl">
    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 sm:p-8 card-panel">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Novo Repertório</h1>
            <p class="mt-1 text-sm text-slate-500">Defina o nome, a data e selecione as músicas do repertório.</p>
        </div>

        <form action="{{ route('repertorios.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <x-label>Nome</x-label>
                    <x-input type="text" name="nome" value="{{ old('nome') }}" placeholder="Ex: Culto de domingo" />
                    <x-error field="nome" />
                </div>

                <div>
                    <x-label>Data</x-label>
                    <x-input type="date" name="data" value="{{ old('data') }}" />
                    <x-error field="data" />
                </div>
            </div>

            <div>
                <x-label>Músicas</x-label>
                <div class="max-h-72 space-y-1 overflow-y-auto rounded-2xl border border-slate-200 bg-slate-50/50 p-3">
                    @forelse($musicas as $musica)
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-white">
                            <input
                                type="checkbox"
                                name="musicas[]"
                                value="{{ $musica->id }}"
                                @checked(collect(old('musicas'))->contains($musica->id))
                                class="h-5 w-5 rounded-md border-slate-300 text-[var(--site-primary)] focus:ring-[var(--site-primary)]/30">
                            <span class="text-sm text-slate-700">{{ $musica->titulo }}</span>
                        </label>
                    @empty
                        <p class="px-3 py-2 text-sm text-slate-400">Nenhuma música disponível. Cadastre músicas primeiro.</p>
                    @endforelse
                </div>
                <x-error field="musicas" />
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <x-button type="submit">Salvar</x-button>
                <a href="{{ route('repertorios.index') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
