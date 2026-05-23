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
        Nova Música
    </h1>

    <form
        action="{{ route('musicas.store') }}"
        method="POST"
        class="space-y-4">

        @csrf

        <div>

            <x-label>
                Título
            </x-label>

            <x-input
                type="text"
                name="titulo"
                value="{{ old('titulo') }}" />

            <x-error field="titulo" />

        </div>

        <div>

            <x-label>
                Artista
            </x-label>

            <x-input
                type="text"
                name="artista"
                value="{{ old('artista') }}" />

            <x-error field="artista" />

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
                ">

                @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}">
                    {{ $categoria->nome }}
                </option>

                @endforeach

            </select>

            <x-error field="categoria_id" />

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection