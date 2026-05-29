<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    @php
    use App\Models\Setting;
    use Illuminate\Support\Facades\Schema;

    $siteSettings = [];
    if (Schema::hasTable('settings')) {
    $siteSettings = Setting::pluck('value', 'key')->toArray();
    }

    $primaryColor = $siteSettings['primary_color'] ?? '#0f172a';
    $accentColor = $siteSettings['accent_color'] ?? '#0ea5e9';
    $backgroundColor = $siteSettings['background_color'] ?? '#f8fafc';
    $textColor = $siteSettings['text_color'] ?? '#0f172a';
    $cardColor = $siteSettings['card_color'] ?? '#ffffff';
    $siteName = $siteSettings['site_name'] ?? 'Louvor Manager';
    @endphp

    <title>
        {{ $siteName }}
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    <style>
        :root {
            --site-primary: {{ $primaryColor }};
            --site-accent: {{ $accentColor }};
            --site-background: {{ $backgroundColor }};
            --site-text: {{ $textColor }};
            --site-card: {{ $cardColor }};
            --site-button-text: #ffffff;
        }

        .btn-primary {
            background: var(--site-primary) !important;
            background-color: var(--site-primary) !important;
            color: var(--site-button-text) !important;
        }

        .btn-secondary {
            background: var(--site-accent) !important;
            background-color: var(--site-accent) !important;
            color: var(--site-button-text) !important;
        }

        .btn-outline {
            border: 1px solid var(--site-primary);
            color: var(--site-primary);
            background: transparent;
        }

        .btn-primary,
        .btn-secondary,
        .btn-outline {
            transition: transform .15s ease, opacity .15s ease, box-shadow .15s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: .92;
        }

        .btn-outline:hover {
            background: var(--site-primary);
            color: var(--site-button-text);
        }

        .card-panel {
            background: var(--site-card);
        }

        .shadow-soft {
            box-shadow: 0 20px 80px rgba(15, 23, 42, 0.12);
        }
    </style>

</head>

<body
    class="min-h-screen font-sans antialiased"
    style="background: var(--site-background); color: var(--site-text);"
    x-data="{ sidebarOpen: false }">

    <!-- TOP BAR (mobile) -->
    <header class="sticky top-0 z-30 flex items-center gap-3 border-b border-slate-200/70 bg-white/80 px-4 py-3 backdrop-blur lg:hidden">

        <button
            type="button"
            @click="sidebarOpen = true"
            class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-700 transition hover:bg-slate-100"
            aria-label="Abrir menu">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>

        <span class="text-lg font-bold text-slate-900">{{ $siteName }}</span>

    </header>

    <!-- BACKDROP (mobile) -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
        style="display: none;"></div>

    <!-- SIDEBAR -->
    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col justify-between bg-slate-900 text-white shadow-2xl transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="{ '!translate-x-0': sidebarOpen }">

        <div class="flex-1 overflow-y-auto">

            <div
                class="flex items-center justify-between gap-3 border-b border-white/10 px-6 py-5"
                style="background: linear-gradient(135deg, var(--site-primary), rgba(15, 23, 42, 0.92));">

                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-white/15 text-lg font-bold">
                        {{ mb_strtoupper(mb_substr($siteName, 0, 1)) }}
                    </span>
                    <span class="text-lg font-bold leading-tight">{{ $siteName }}</span>
                </div>

                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-white/80 transition hover:bg-white/10 lg:hidden"
                    aria-label="Fechar menu">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            <nav class="space-y-1 p-4">

                @php
                $linkBase = 'group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition';
                $linkIdle = 'text-slate-300 hover:bg-white/10 hover:text-white';
                $linkActive = 'bg-white/10 text-white shadow-inner';
                @endphp

                @if(auth()->user()->isAdmin())
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25A2.25 2.25 0 0 1 13.5 8.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    Dashboard
                </a>

                <a
                    href="{{ route('users.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('users.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Usuários
                </a>

                <a
                    href="{{ route('settings.edit') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('settings.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Configurações
                </a>
                @endif

                <a
                    href="{{ route('categorias.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('categorias.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    Categorias
                </a>

                <a
                    href="{{ route('musicas.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('musicas.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553z" />
                    </svg>
                    Músicas
                </a>

                <a
                    href="{{ route('repertorios.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('repertorios.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                    Repertórios
                </a>

                <a
                    href="{{ route('escalas.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('escalas.*') ? $linkActive : $linkIdle }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    Escala da Semana
                </a>

            </nav>

        </div>

        <div class="border-t border-white/10 p-4">

            <div class="mb-3 flex items-center gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-white/10 text-sm font-semibold uppercase">
                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                </span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <form
                action="{{ route('logout') }}"
                method="POST">

                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-500/90 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    Sair
                </button>

            </form>

        </div>

    </aside>

    <!-- CONTEÚDO -->
    <div class="lg:pl-72">

        <main class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-10">

            @if(session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>

            @endif

            @yield('content')

        </main>

    </div>

</body>

</html>
