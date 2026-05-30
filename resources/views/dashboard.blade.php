@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <div>
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Dashboard</h1>
        <p class="mt-1 text-sm text-slate-500">Visão geral do seu repertório, músicas e categorias.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <div class="group rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 transition hover:-translate-y-1 card-panel">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Total de Músicas</p>
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-100 text-sky-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553z" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ $totalMusicas }}</p>
        </div>

        <div class="group rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 transition hover:-translate-y-1 card-panel">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Total de Categorias</p>
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-violet-100 text-violet-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ $totalCategorias }}</p>
        </div>

        <div class="group rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 transition hover:-translate-y-1 card-panel">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">Total de Repertórios</p>
                <span class="grid h-11 w-11 place-items-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ $totalRepertorios }}</p>
        </div>

    </div>

    {{-- Músicas por categoria --}}
    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 card-panel">

        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-slate-900 sm:text-xl">Músicas por Categoria</h2>
            <span class="inline-flex items-center rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                {{ $totalMusicas }} no total
            </span>
        </div>

        @forelse($musicasPorCategoria as $categoria)
            @php
                $percentual = $totalMusicas > 0 ? round(($categoria->musicas_count / $totalMusicas) * 100) : 0;
            @endphp
            <div class="py-3 @if(!$loop->last) border-b border-slate-100 @endif">
                <div class="flex items-center justify-between gap-3">
                    <span class="text-sm font-medium text-slate-700">Categoria {{ $categoria->nome }}</span>
                    <span class="text-sm font-semibold text-slate-900">
                        {{ $categoria->musicas_count }} {{ $categoria->musicas_count == 1 ? 'música' : 'músicas' }}
                    </span>
                </div>
                <div class="mt-2 h-2 w-full overflow-hidden rounded-full bg-slate-100">
                    <div class="h-full rounded-full bg-[var(--site-accent)]" style="width: {{ $percentual }}%"></div>
                </div>
            </div>
        @empty
            <p class="py-6 text-center text-sm text-slate-500">Nenhuma categoria cadastrada ainda.</p>
        @endforelse

    </div>

    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 card-panel">

        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-slate-900 sm:text-xl">Últimos Repertórios</h2>
            <a
                href="{{ route('repertorios.index') }}"
                class="inline-flex items-center gap-1 text-sm font-semibold text-[var(--site-accent)] hover:underline">
                Ver todos
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5 15.75 12l-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nome</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($ultimosRepertorios as $repertorio)
                        <tr class="transition hover:bg-slate-50">
                            <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-slate-900">{{ $repertorio->nome }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ \Carbon\Carbon::parse($repertorio->data)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-4 py-10 text-center text-sm text-slate-500">Nenhum repertório encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
