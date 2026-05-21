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
        Editar Categoria
    </h1>

    <form
        action="{{ route('categorias.update', $categoria->id) }}"
        method="POST"
        class="space-y-4"
    >

        @csrf
        @method('PUT')

        <div>

            <x-label>
                Nome
            </x-label>

            <x-input
                type="text"
                name="nome"
                value="{{ old('nome', $categoria->nome) }}"
            />

            <x-error field="nome" />

        </div>

        <x-button type="submit">
            Atualizar
        </x-button>

    </form>

</div>

@endsection