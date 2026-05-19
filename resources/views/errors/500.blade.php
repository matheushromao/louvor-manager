@extends('layouts.app')

@section('content')

<div
    class="
        flex
        flex-col
        items-center
        justify-center
        py-20
    "
>

    <h1
        class="
            text-7xl
            font-bold
            text-red-500
        "
    >
        500
    </h1>

    <p
        class="
            text-2xl
            text-gray-700
            mt-4
        "
    >
        Erro interno do servidor.
    </p>

    <p
        class="
            text-gray-500
            mt-2
        "
    >
        Ocorreu um erro inesperado no sistema.
    </p>

    <a
        href="{{ route('dashboard') }}"
        class="
            mt-6
            bg-blue-500
            text-white
            px-6
            py-3
            rounded
            hover:bg-blue-600
        "
    >
        Voltar ao Dashboard
    </a>

</div>

@endsection