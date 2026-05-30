@extends('layouts.app')

@section('content')

@php
    $canManage = auth()->user()->isAdmin();
    $busca = $filtros['busca'] ?? null;
    $categoriaId = $filtros['categoria_id'] ?? null;
    $temFiltros = filled($busca) || filled($categoriaId);
    $categoriaAtiva = $categoriaId ? $categorias->firstWhere('id', (int) $categoriaId) : null;
@endphp

<div class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Músicas</h1>
            <p class="mt-1 text-sm text-slate-500">Cadastre e organize as músicas do seu repertório.</p>
        </div>
        @if($canManage)
            <a
                href="{{ route('musicas.create') }}"
                class="btn-primary inline-flex items-center justify-center gap-2 rounded-full px-5 py-2.5 text-sm font-semibold shadow-soft">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nova Música
            </a>
        @endif
    </div>

    {{-- Barra de pesquisa e filtro por categoria --}}
    <form method="GET" action="{{ route('musicas.index') }}" class="rounded-3xl bg-white p-4 shadow-soft ring-1 ring-slate-900/5 card-panel">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
            <div class="flex-1">
                <label for="busca" class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Pesquisar</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </span>
                    <input
                        type="text"
                        name="busca"
                        id="busca"
                        value="{{ $busca }}"
                        placeholder="Buscar pelo nome da música..."
                        class="w-full rounded-xl border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[var(--site-primary)] focus:ring-[var(--site-primary)]/30">
                </div>
            </div>

            <div class="sm:w-56">
                <label for="categoria_id" class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Categoria</label>
                <select
                    name="categoria_id"
                    id="categoria_id"
                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm transition focus:border-[var(--site-primary)] focus:ring-[var(--site-primary)]/30">
                    <option value="">Todas as categorias</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((int) $categoriaId === $categoria->id)>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="btn-primary inline-flex items-center justify-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold shadow-soft">
                    Filtrar
                </button>
                @if($temFiltros)
                    <a
                        href="{{ route('musicas.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                        Limpar
                    </a>
                @endif
            </div>
        </div>

        {{-- Indicação visual dos filtros ativos --}}
        @if($temFiltros)
            <div class="mt-4 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-4">
                <span class="text-xs font-medium text-slate-500">Filtros ativos:</span>
                @if(filled($busca))
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-3 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-200">
                        Pesquisa: “{{ $busca }}”
                    </span>
                @endif
                @if($categoriaAtiva)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-3 py-1 text-xs font-medium text-violet-700 ring-1 ring-violet-200">
                        Categoria: {{ $categoriaAtiva->nome }}
                    </span>
                @endif
            </div>
        @endif
    </form>

    <div class="rounded-3xl bg-white p-2 shadow-soft ring-1 ring-slate-900/5 sm:p-4 card-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="rounded-l-xl px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Título</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Artista</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Tom</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">YouTube</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Categoria</th>
                        @if($canManage)
                            <th class="rounded-r-xl px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($musicas as $musica)
                        <tr class="transition hover:bg-slate-50">
                            <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-slate-900">{{ $musica->titulo }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $musica->artista }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-700">{{ $musica->tom }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm">
                                @if($musica->youtube_link)
                                    <a
                                        href="{{ $musica->youtube_link }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 ring-1 ring-red-200 transition hover:bg-red-100">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31.3 31.3 0 0 0 0 12a31.3 31.3 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.3 31.3 0 0 0 24 12a31.3 31.3 0 0 0-.5-5.8ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z" />
                                        </svg>
                                        Assistir
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400">Sem link</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm">
                                <span class="inline-flex items-center rounded-full bg-sky-50 px-3 py-1 text-xs font-medium text-sky-700">{{ $musica->categoria->nome }}</span>
                            </td>
                            @if($canManage)
                                <td class="whitespace-nowrap px-4 py-3 text-right text-sm">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            href="{{ route('musicas.edit', $musica->id) }}"
                                            class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-amber-200 transition hover:bg-amber-100">
                                            Editar
                                        </a>
                                        <form action="{{ route('musicas.destroy', $musica->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                onclick="return confirm('Deseja realmente excluir esta música?')"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $canManage ? 6 : 5 }}" class="px-4 py-12 text-center text-sm text-slate-500">
                                @if($temFiltros)
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                        <p class="font-medium text-slate-600">Nenhuma música encontrada para os filtros aplicados.</p>
                                        <a href="{{ route('musicas.index') }}" class="text-sm font-semibold text-[var(--site-accent)] hover:underline">Limpar filtros</a>
                                    </div>
                                @else
                                    Nenhuma música cadastrada ainda.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>{{ $musicas->links() }}</div>

</div>

@endsection
