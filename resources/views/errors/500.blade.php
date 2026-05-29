@extends('layouts.app')

@section('content')

<div class="flex min-h-[60vh] flex-col items-center justify-center text-center">
    <p class="text-7xl font-black text-red-500 sm:text-8xl">500</p>
    <h1 class="mt-4 text-2xl font-bold text-slate-900">Erro interno do servidor</h1>
    <p class="mt-2 max-w-md text-sm text-slate-500">Ocorreu um erro inesperado no sistema. Tente novamente em instantes.</p>
    <a
        href="{{ route('dashboard') }}"
        class="btn-primary mt-8 inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-soft">
        Voltar ao Dashboard
    </a>
</div>

@endsection
