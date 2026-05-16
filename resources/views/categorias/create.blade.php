@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
        max-w-xl
    "
>

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        "
    >
        Nova Categoria
    </h1>

    <form
        action="{{ route('categorias.store') }}"
        method="POST"
    >

        @csrf

        <div class="mb-4">

            <label
                class="
                    block
                    mb-2
                    font-medium
                "
            >
                Nome
            </label>

            <input
                type="text"
                name="nome"
                value="{{ old('nome') }}"
                class="
                    w-full
                    border
                    rounded
                    p-2
                "
            >

            @error('nome')

                <p class="text-red-500 mt-1">
                    {{ $message }}
                </p>

            @enderror

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