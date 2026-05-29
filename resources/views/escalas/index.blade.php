@extends('layouts.app')

@section('content')

@php $canManage = auth()->user()->canManageEscala(); @endphp

<div class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Escala da Semana</h1>
            <p class="mt-1 text-sm text-slate-500">Organize os vocais escalados para cantar em cada culto.</p>
        </div>
        @if($canManage)
            <a
                href="{{ route('escalas.create') }}"
                class="btn-primary inline-flex items-center justify-center gap-2 rounded-full px-5 py-2.5 text-sm font-semibold shadow-soft">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nova Escala
            </a>
        @endif
    </div>

    <div class="rounded-3xl bg-white p-2 shadow-soft ring-1 ring-slate-900/5 sm:p-4 card-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="rounded-l-xl px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Data do culto</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Vocais escalados</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Observação</th>
                        <th class="rounded-r-xl px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($escalas as $escala)
                        <tr class="transition hover:bg-slate-50">
                            <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-slate-900">{{ $escala->data->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex max-w-md flex-wrap gap-1.5">
                                    @forelse($escala->usuarios as $vocal)
                                        <span class="inline-flex items-center rounded-full bg-sky-50 px-2.5 py-1 text-xs font-medium text-sky-700">{{ $vocal->name }}</span>
                                    @empty
                                        <span class="text-xs text-slate-400">Nenhum vocal</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="max-w-xs px-4 py-3 text-sm text-slate-600">
                                {{ \Illuminate\Support\Str::limit($escala->observacao, 60) ?: '—' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right text-sm">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('escalas.show', $escala) }}"
                                        class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-200">
                                        Ver
                                    </a>
                                    @if($canManage)
                                        <a
                                            href="{{ route('escalas.edit', $escala) }}"
                                            class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-amber-200 transition hover:bg-amber-100">
                                            Editar
                                        </a>
                                        <form action="{{ route('escalas.destroy', $escala) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                onclick="return confirm('Deseja realmente excluir esta escala?')"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 ring-1 ring-red-200 transition hover:bg-red-100">
                                                Excluir
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-sm text-slate-500">Nenhuma escala cadastrada ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>{{ $escalas->links() }}</div>

</div>

@endsection
