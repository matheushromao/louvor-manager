@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
        max-w-2xl
    ">

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        ">
        Nova Música
    </h1>

    <form
        action="{{ route('musicas.store') }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Título
            </label>

            <input
                type="text"
                name="titulo"
                value="{{ old('titulo') }}"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

            @error('titulo')

            <p class="text-red-500 mt-1">
                {{ $message }}
            </p>

            @enderror

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Artista
            </label>

            <input
                type="text"
                name="artista"
                value="{{ old('artista') }}"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Tom
            </label>

            <input
                type="text"
                name="tom"
                value="{{ old('tom') }}"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Categoria
            </label>

            <select
                name="categoria_id"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

                @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}">
                    {{ $categoria->nome }}
                </option>

                @endforeach

            </select>

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection