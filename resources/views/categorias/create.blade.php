@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow-md
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
        class="space-y-4"
    >

        @csrf

        <div>

            <x-label>
                Nome
            </x-label>

            <x-input
                type="text"
                name="nome"
                value="{{ old('nome') }}"
            />

            <x-error field="nome" />

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection