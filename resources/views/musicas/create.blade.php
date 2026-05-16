@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
        max-w-2xl
    "
>

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        "
    >
        Nova Música
    </h1>

    <form
        action="{{ route('musicas.store') }}"
        method="POST"
    >

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
                "
            >

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
                "
            >

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
                "
            >

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
                "
            >

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                    >
                        {{ $categoria->nome }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Letra
            </label>

            <textarea
                name="letra"
                rows="6"
                class="
                    w-full
                    border
                    rounded
                    p-2
                "
            >{{ old('letra') }}</textarea>

        </div>

        <button
            type="submit"
            class="
                bg-blue-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-blue-600
            "
        >
            Salvar
        </button>

    </form>

</div>

@endsection