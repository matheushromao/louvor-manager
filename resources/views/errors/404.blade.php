@extends('layouts.app')

@section('content')

<div class="flex min-h-[60vh] flex-col items-center justify-center text-center">
    <p class="text-7xl font-black text-[var(--site-primary)] sm:text-8xl">404</p>
    <h1 class="mt-4 text-2xl font-bold text-slate-900">Página não encontrada</h1>
    <p class="mt-2 max-w-md text-sm text-slate-500">A página que você procura pode ter sido movida ou não existe mais.</p>
    <a
        href="{{ route('dashboard') }}"
        class="btn-primary mt-8 inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-soft">
        Voltar ao Dashboard
    </a>
</div>

@endsection
