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

</head>

<body class="bg-gray-100">

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
                        border-gray-700
                    ">
                    Louvor Manager
                </div>

                <nav class="p-4 space-y-2">

                    @if(auth()->user()->isAdmin())

                    <a
                        href="{{ route('users.index') }}"
                        class="
                             text-gray-700
                             hover:text-blue-600
                                ">
                        Usuários
                    </a>

                    <a
                        href="{{ route('settings.edit') }}"
                        class="
                             text-gray-700
                             hover:text-blue-600
                                ">
                        Configurações
                    </a>

                    @endif

                    <a
                        href="{{ route('dashboard') }}"
                        class="
                            block
                            px-4
                            py-3
                            rounded
                            hover:bg-gray-800

                            {{ request()->routeIs('dashboard')
                                 ? 'bg-gray-800'
                                  : ''
                                }}
                        ">
                        Dashboard
                    </a>

                    <a
                        href="{{ route('categorias.index') }}"
                        class="
                            block
                            px-4
                            py-3
                            rounded
                            hover:bg-gray-800

                            {{ request()->routeIs('categorias.*')
                                ? 'bg-gray-800'
                                : ''
                            }}
                        ">
                        Categorias
                    </a>

                    <a
                        href="{{ route('musicas.index') }}"
                        class="
                            block
                            px-4
                            py-3
                            rounded
                            hover:bg-gray-800

                            {{ request()->routeIs('musicas.*')
                                ? 'bg-gray-800'
                                : ''
                            }}
                        ">
                        Músicas
                    </a>

                    <a
                        href="{{ route('repertorios.index') }}"
                        class="
                            block
                            px-4
                            py-3
                            rounded
                            hover:bg-gray-800

                            {{ request()->routeIs('repertorios.*')
                                ? 'bg-gray-800'
                                : ''
                            }}
                        ">
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