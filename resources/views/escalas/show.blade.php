@extends('layouts.app')

@section('content')

@php $canManage = auth()->user()->canManageEscala(); @endphp

<div class="mx-auto max-w-3xl space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Escala da Semana</h1>
            <p class="mt-1 text-sm text-slate-500">Detalhes da escala do culto.</p>
        </div>
        <a href="{{ route('escalas.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 sm:p-8 card-panel">

        <div class="flex items-center gap-4 border-b border-slate-100 pb-6">
            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-sky-100 text-sky-600">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </span>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Data do culto</p>
                <p class="text-xl font-bold text-slate-900">{{ $escala->data->translatedFormat('d \d\e F \d\e Y') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Observação</p>
            <p class="mt-1 text-sm text-slate-700">{{ $escala->observacao ?: 'Nenhuma observação registrada.' }}</p>
        </div>

        <div class="mt-6">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Vocais escalados ({{ $escala->usuarios->count() }})</p>
            <div class="mt-3 space-y-2">
                @forelse($escala->usuarios as $vocal)
                    <div class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50/60 px-4 py-2.5">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[var(--site-primary)] text-sm font-semibold uppercase text-white">
                            {{ \Illuminate\Support\Str::substr($vocal->name, 0, 1) }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-slate-900">{{ $vocal->name }}</p>
                            <p class="truncate text-xs text-slate-500">{{ $vocal->email }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Nenhum vocal escalado.</p>
                @endforelse
            </div>
        </div>

        @if($canManage)
            <div class="mt-8 flex flex-wrap items-center gap-3 border-t border-slate-100 pt-6">
                <a href="{{ route('escalas.edit', $escala) }}" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-soft">Editar escala</a>
                <form action="{{ route('escalas.destroy', $escala) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        onclick="return confirm('Deseja realmente excluir esta escala?')"
                        class="inline-flex items-center justify-center rounded-full bg-red-50 px-6 py-3 text-sm font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
                        Excluir
                    </button>
                </form>
            </div>
        @endif

    </div>

</div>

@endsection
