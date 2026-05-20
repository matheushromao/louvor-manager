@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
        max-w-xl
    ">

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        ">
        Nova Categoria
    </h1>

    <form
        action="{{ route('categorias.store') }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label
                class="
                    block
                    mb-2
                    font-medium
                ">
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
                ">

            @error('nome')

            <p class="text-red-500 mt-1">
                {{ $message }}
            </p>

            @enderror

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection