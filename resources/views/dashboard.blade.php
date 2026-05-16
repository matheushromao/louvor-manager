@extends('layouts.app')

@section('content')

<div class="mb-8">

    <h1
        class="
            text-3xl
            font-bold
            mb-2
        "
    >
        Dashboard
    </h1>

    <p class="text-gray-600">
        Bem-vindo ao sistema Louvor Manager.
    </p>

</div>

<!-- CARDS -->
<div
    class="
        grid
        grid-cols-1
        md:grid-cols-3
        gap-6
    "
>

    <!-- CARD MÚSICAS -->
    <div
        class="
            bg-white
            p-6
            rounded-lg
            shadow
        "
    >

        <h2 class="text-gray-500">
            Total de Músicas
        </h2>

        <p
            class="
                text-4xl
                font-bold
                mt-2
            "
        >
            {{ $totalMusicas }}
        </p>

    </div>

    <!-- CARD CATEGORIAS -->
    <div
        class="
            bg-white
            p-6
            rounded-lg
            shadow
        "
    >

        <h2 class="text-gray-500">
            Total de Categorias
        </h2>

        <p
            class="
                text-4xl
                font-bold
                mt-2
            "
        >
            {{ $totalCategorias }}
        </p>

    </div>

    <!-- CARD USUÁRIOS -->
    <div
        class="
            bg-white
            p-6
            rounded-lg
            shadow
        "
    >

        <h2 class="text-gray-500">
            Usuários
        </h2>

        <p
            class="
                text-4xl
                font-bold
                mt-2
            "
        >
            {{ $totalUsuarios }}
        </p>

    </div>

</div>

<!-- AÇÕES RÁPIDAS -->
<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
        mt-8
    "
>

    <h2
        class="
            text-2xl
            font-bold
            mb-4
        "
    >
        Ações Rápidas
    </h2>

    <div class="flex gap-4">

        <a
            href="{{ route('musicas.create') }}"
            class="
                bg-blue-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-blue-600
            "
        >
            Nova Música
        </a>

        <a
            href="{{ route('categorias.create') }}"
            class="
                bg-green-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-green-600
            "
        >
            Nova Categoria
        </a>

    </div>

</div>

@endsection