@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow-md
        max-w-2xl
    ">

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        ">
        Editar Música
    </h1>

    <form
        action="{{ route('musicas.update', $musica->id) }}"
        method="POST"
        class="space-y-4">

        @csrf
        @method('PUT')

        <div>

            <x-label>
                Título
            </x-label>

            <x-input
                type="text"
                name="titulo"
                value="{{ old('titulo', $musica->titulo) }}" />

            <x-error field="titulo" />

        </div>

        <div>

            <x-label>
                Artista
            </x-label>

            <x-input
                type="text"
                name="artista"
                value="{{ old('artista', $musica->artista) }}" />

            <x-error field="cantor" />

        </div>

        <div>

            <x-label>
                Tom
            </x-label>

            <x-input
                type="text"
                name="tom"
                value="{{ old('tom') }}" />

            <x-error field="tom" />

        </div>

        <div>

            <x-label>
                Link YouTube
            </x-label>

            <x-input
                type="url"
                name="youtube_link"
                value="{{ old('youtube_link', $musica->youtube_link ?? '') }}"
                placeholder="https://youtube.com/..." />

        </div>

        <div>

            <x-label>
                Categoria
            </x-label>

            <select
                name="categoria_id"
                class="
                    w-full
                    border
                    border-gray-300
                    rounded-lg
                    p-3
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-500
                ">

                @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}"
                    @selected(
                    old( 'categoria_id' ,
                    $musica->categoria_id
                    ) == $categoria->id
                    )
                    >
                    {{ $categoria->nome }}
                </option>

                @endforeach

            </select>

            <x-error field="categoria_id" />

        </div>

        <x-button type="submit">
            Atualizar
        </x-button>

    </form>

</div>

@endsection