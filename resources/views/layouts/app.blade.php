<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Louvor Manager</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside
            class="
                w-64
                bg-gray-900
                text-white
                p-6
            ">

            <h1 class="text-2xl font-bold mb-8">
                Louvor Manager
            </h1>

            <nav class="flex flex-col gap-4">
                <a
                    href="{{ route('dashboard') }}"
                    class="
                      hover:bg-gray-700
                     p-2
                    rounded
                    ">
                    Dashboard
                </a>
                <a
                    href="{{ route('categorias.index') }}"
                    class="
                        hover:bg-gray-700
                        p-2
                        rounded
                    ">

                    Categorias
                </a>

                <a
                    href="{{ route('musicas.index') }}"
                    class="
                        hover:bg-gray-700
                        p-2
                        rounded
                    ">
                    Músicas
                </a>

                <a
                    href="{{ route('repertorios.index') }}"
                    class="
                     hover:bg-gray-700
                     p-2
                        rounded
                    ">
                    Repertórios
                </a>

            </nav>

        </aside>

        <!-- CONTEÚDO -->
        <div class="flex-1 flex flex-col">

            <!-- NAVBAR -->
            <header
                class="
                    bg-white
                    shadow
                    p-4
                    flex
                    justify-between
                    items-center
                ">

                <h2 class="text-xl font-semibold">
                    Painel Administrativo
                </h2>

                <div class="flex items-center gap-4">

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    <form
                        action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="
                                bg-red-500
                                text-white
                                px-4
                                py-2
                                rounded
                                hover:bg-red-600
                            ">
                            Logout
                        </button>

                    </form>

                </div>

            </header>

            <!-- CONTEÚDO DINÂMICO -->
            <main class="p-6">

                @if(session('success'))

                <div
                    class="
                            bg-green-200
                            text-green-800
                            p-4
                            rounded
                            mb-4
                        ">

                    {{ session('success') }}

                </div>

                @endif

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>