<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Louvor Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        use App\Models\Setting;
        use Illuminate\Support\Facades\Schema;

        $settings = [];
        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'key')->toArray();
        }

        $primary = $settings['primary_color'] ?? '#0f172a';
        $accent = $settings['accent_color'] ?? '#0ea5e9';
        $background = $settings['background_color'] ?? '#f8fafc';
        $text = $settings['text_color'] ?? '#0f172a';
        $siteName = $settings['site_name'] ?? 'Louvor Manager';
        $footerText = $settings['footer_text'] ?? 'Gestão de repertório e músicas para sua igreja.';
    @endphp
    <style>
        :root {
            --site-primary: {{ $primary }};
            --site-accent: {{ $accent }};
            --site-background: {{ $background }};
            --site-text: {{ $text }};
        }
        body {
            background: var(--site-background);
            color: var(--site-text);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_right,_rgba(14,165,233,0.18),_transparent_35%),linear-gradient(to_bottom,_var(--site-background),_white)] text-slate-900">
        <header class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-3">
                    <div class="grid h-14 w-14 place-items-center rounded-3xl bg-gradient-to-br from-slate-900 to-sky-600 text-white shadow-xl shadow-slate-500/20">
                        <span class="text-xl font-semibold">L</span>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.32em] text-slate-600">{{ $siteName }}</p>
                        <h1 class="text-2xl font-semibold text-slate-900 lg:text-3xl">Gestão completa de repertório com identidade visual personalizável</h1>
                    </div>
                </div>
                <nav class="flex flex-wrap items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-300 bg-white px-5 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-50">Painel</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-[var(--site-primary)] px-5 py-2 text-sm font-semibold text-white shadow-lg transition hover:opacity-90">Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-full border border-[var(--site-primary)] bg-white px-5 py-2 text-sm font-semibold text-[var(--site-primary)] transition hover:bg-slate-50">Registrar</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-20 lg:px-8">
            <section class="grid gap-10 lg:grid-cols-[1.25fr_0.85fr] lg:items-center">
                <div class="space-y-8">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[var(--site-primary)] bg-[var(--site-primary)]/10 px-4 py-2 text-sm font-semibold text-[var(--site-primary)]">
                        Nova identidade visual
                    </span>
                    <div class="space-y-6">
                        <h2 class="text-4xl font-semibold tracking-tight text-slate-900 sm:text-5xl">Sistema de gerenciamento para músicas, categorias e repertórios de igreja</h2>
                        <p class="max-w-2xl text-lg leading-8 text-slate-600">Gerencie repertórios, organize músicas e configure permissões de acesso com estilo inspirado em sites institucionais modernos.</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-full bg-[var(--site-primary)] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:opacity-90">Ir para o painel</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-[var(--site-primary)] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:opacity-90">Entrar</a>
                            @if(Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-[var(--site-accent)] px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:opacity-90">Criar conta</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="overflow-hidden rounded-[2rem] bg-white/95 p-8 shadow-[0_30px_80px_rgba(15,23,42,0.12)]">
                    <div class="space-y-6">
                        <div class="rounded-3xl bg-gradient-to-br from-slate-900 via-sky-700 to-cyan-500 px-6 py-8 text-white shadow-xl">
                            <p class="text-sm uppercase tracking-[0.28em] text-slate-200">Controle de cor</p>
                            <h3 class="mt-4 text-3xl font-semibold">Visual ajustável para seu projeto</h3>
                            <p class="mt-4 text-sm leading-6 text-slate-200/90">Defina as cores do site diretamente no painel de configurações e tenha controle total da aparência.</p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Categorias</p>
                                <p class="mt-3 text-sm text-slate-600">Organize cada estilo musical em categorias claras e acessíveis.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Músicas</p>
                                <p class="mt-3 text-sm text-slate-600">Cadastre letras, acordes e informações importantes de cada música.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Repertórios</p>
                                <p class="mt-3 text-sm text-slate-600">Monte repertórios rápidos para celebrações e eventos.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 p-5 shadow-sm">
                                <p class="text-sm font-semibold text-slate-900">Controle de acesso</p>
                                <p class="mt-3 text-sm text-slate-600">Apenas admins gerenciam usuários, configurações e painel de controle.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200/70 bg-white/80 py-10 text-center text-sm text-slate-600 shadow-sm shadow-slate-900/5">
            <p class="font-semibold text-slate-900">{{ $siteName }}</p>
            <p class="mt-2">{{ $footerText }}</p>
        </footer>
    </div>
</body>
</html>
