<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        $siteName = $settings['site_name'] ?? 'Louvor Manager';
        $tagline = $settings['footer_text'] ?? 'Organize músicas, repertórios e escalas da sua igreja em um só lugar.';

        $logoUrl = Setting::fileUrl($settings['logo_path'] ?? null);
        $bgImageUrl = Setting::fileUrl($settings['background_image_path'] ?? null);

        $heroStyle = $bgImageUrl
            ? 'background-image: linear-gradient(to bottom, rgba(255,255,255,0.82), rgba(255,255,255,0.93)), url(' . $bgImageUrl . '); background-size: cover; background-position: center;'
            : 'background-image: radial-gradient(circle at top, rgba(14,165,233,0.14), transparent 45%), linear-gradient(to bottom, var(--site-background), #ffffff);';
    @endphp

    <title>{{ $siteName }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --site-primary: {{ $primary }};
            --site-accent: {{ $accent }};
            --site-background: {{ $background }};
        }
        .btn-primary {
            background: var(--site-primary);
            color: #fff;
            transition: opacity .15s ease;
        }
        .btn-primary:hover { opacity: .9; }
    </style>
</head>
<body class="antialiased text-slate-900">
    <div class="flex min-h-screen flex-col" style="{{ $heroStyle }}">

        <!-- Cabeçalho -->
        <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-6">
            <a href="/" class="flex items-center gap-3">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-11 w-11 rounded-2xl bg-white object-contain p-1 shadow-md">
                @else
                    <span class="grid h-11 w-11 place-items-center rounded-2xl text-lg font-bold text-white shadow-md" style="background: linear-gradient(135deg, var(--site-primary), var(--site-accent));">
                        {{ \Illuminate\Support\Str::substr($siteName, 0, 1) }}
                    </span>
                @endif
                <span class="text-lg font-bold">{{ $siteName }}</span>
            </a>

            <nav class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route(auth()->user()->homeRoute()) }}" class="btn-primary rounded-full px-5 py-2 text-sm font-semibold shadow-sm">Acessar o sistema</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary rounded-full px-5 py-2 text-sm font-semibold shadow-sm">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-full border border-slate-300 bg-white/70 px-5 py-2 text-sm font-semibold text-slate-700 backdrop-blur transition hover:bg-white">Criar conta</a>
                    @endif
                @endauth
            </nav>
        </header>

        <!-- Conteúdo principal -->
        <main class="mx-auto flex w-full max-w-3xl flex-1 flex-col items-center justify-center px-6 py-12 text-center">

            <span class="inline-flex items-center gap-2 rounded-full bg-white/70 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-[var(--site-accent)] ring-1 ring-slate-200 backdrop-blur">
                {{ $settings['church_name'] ?? 'Ministério de Louvor' }}
            </span>

            <h1 class="mt-6 text-4xl font-bold tracking-tight sm:text-5xl">
                {{ $siteName }}
            </h1>

            <p class="mt-4 max-w-xl text-base text-slate-600 sm:text-lg">
                {{ $tagline }}
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                @auth
                    <a href="{{ route(auth()->user()->homeRoute()) }}" class="btn-primary inline-flex items-center justify-center rounded-full px-7 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Ir para o sistema</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary inline-flex items-center justify-center rounded-full px-7 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-7 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Criar conta</a>
                    @endif
                @endauth
            </div>

            <!-- Destaques -->
            <div class="mt-14 grid w-full grid-cols-1 gap-4 sm:grid-cols-3">
                @php
                    $features = [
                        ['Músicas', 'Acervo organizado por categorias', 'M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553z'],
                        ['Repertórios', 'Monte cultos em minutos', 'M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5'],
                        ['Escala', 'Vocais escalados por culto', 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5'],
                    ];
                @endphp
                @foreach($features as [$title, $desc, $icon])
                    <div class="rounded-2xl bg-white/80 p-5 text-left shadow-sm ring-1 ring-slate-200/70 backdrop-blur">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-[var(--site-primary)]/10 text-[var(--site-primary)]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
                            </svg>
                        </span>
                        <p class="mt-3 text-sm font-semibold text-slate-900">{{ $title }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>

        </main>

        <footer class="px-6 py-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} {{ $siteName }}
        </footer>

    </div>
</body>
</html>
