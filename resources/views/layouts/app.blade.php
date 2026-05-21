<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Louvor Manager
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

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
    @endphp

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

        .card-panel {
            background: var(--site-card);
        }
    </style>

</head>

<body class="min-h-screen font-sans" style="background: var(--site-background); color: var(--site-text);">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->

        <aside
            class="
                w-64
                bg-gray-900
                text-white
                flex
                flex-col
                justify-between
            ">

            <div>

                <div
                    class="
                        p-6
                        text-2xl
                        font-bold
                        border-b
                        border-white/10
                    "
                    style="background: linear-gradient(180deg, var(--site-primary), rgba(15, 23, 42, 0.92)); color: white;">
                    {{ $siteSettings['site_name'] ?? 'Louvor Manager' }}
                </div>

                <nav class="p-4 space-y-2">

                    @if(auth()->user()->isAdmin())
                    <a
                        href="{{ route('dashboard') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
                        Dashboard
                    </a>

                    <a
                        href="{{ route('users.index') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('users.*') ? 'bg-white/10' : '' }}">
                        Usuários
                    </a>

                    <a
                        href="{{ route('settings.edit') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('settings.*') ? 'bg-white/10' : '' }}">
                        Configurações
                    </a>
                    @endif

                    <a
                        href="{{ route('categorias.index') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('categorias.*') ? 'bg-white/10' : '' }}">
                        Categorias
                    </a>

                    <a
                        href="{{ route('musicas.index') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('musicas.*') ? 'bg-white/10' : '' }}">
                        Músicas
                    </a>

                    <a
                        href="{{ route('repertorios.index') }}"
                        class="block rounded-lg px-4 py-3 transition hover:bg-white/10 text-white {{ request()->routeIs('repertorios.*') ? 'bg-white/10' : '' }}">
                        Repertórios
                    </a>

                </nav>

            </div>

            <div
                class="
                    p-4
                    border-t
                    border-gray-700
                ">

                <div class="mb-4">

                    {{ auth()->user()->name }}

                </div>

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="
                            w-full
                            bg-red-500
                            hover:bg-red-600
                            py-2
                            rounded
                        ">
                        Logout
                    </button>

                </form>

            </div>

        </aside>

        <!-- CONTEÚDO -->

        <main class="flex-1 p-8 overflow-y-auto">

            @if(session('success'))

            <div
                class="
                        bg-green-100
                        border
                        border-green-400
                        text-green-700
                        px-4
                        py-3
                        rounded
                        mb-6
                    ">

                {{ session('success') }}

            </div>

            @endif

            @yield('content')

        </main>

    </div>

</body>

</html>
