@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-3xl">
    <div class="rounded-3xl bg-white p-6 shadow-soft ring-1 ring-slate-900/5 sm:p-8 card-panel">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Editar Escala</h1>
            <p class="mt-1 text-sm text-slate-500">Atualize a data, a observação e os vocais escalados.</p>
        </div>

        <form action="{{ route('escalas.update', $escala) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-label>Data do culto</x-label>
                <x-input type="date" name="data" value="{{ old('data', $escala->data->format('Y-m-d')) }}" />
                <x-error field="data" />
            </div>

            <div>
                <x-label>Observação <span class="font-normal text-slate-400">(opcional)</span></x-label>
                <textarea
                    name="observacao"
                    rows="3"
                    placeholder="Ex: ensaio às 18h, levar partituras..."
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition placeholder:text-slate-400 focus:border-[var(--site-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--site-primary)]/20">{{ old('observacao', $escala->observacao) }}</textarea>
                <x-error field="observacao" />
            </div>

            <div>
                <x-label>Vocais escalados</x-label>
                <div class="max-h-72 space-y-1 overflow-y-auto rounded-2xl border border-slate-200 bg-slate-50/50 p-3">
                    @forelse($vocais as $vocal)
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-white">
                            <input
                                type="checkbox"
                                name="usuarios[]"
                                value="{{ $vocal->id }}"
                                @checked(collect(old('usuarios', $escala->usuarios->pluck('id')->all()))->contains($vocal->id))
                                class="h-5 w-5 rounded-md border-slate-300 text-[var(--site-primary)] focus:ring-[var(--site-primary)]/30">
                            <span class="text-sm text-slate-700">{{ $vocal->name }}</span>
                        </label>
                    @empty
                        <p class="px-3 py-2 text-sm text-slate-400">Nenhum usuário com a função "vocal" cadastrado ainda.</p>
                    @endforelse
                </div>
                <x-error field="usuarios" />
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <x-button type="submit">Atualizar</x-button>
                <a href="{{ route('escalas.index') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
