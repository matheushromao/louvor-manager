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
        Novo Repertório
    </h1>

    <form
        action="{{ route('repertorios.store') }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Nome
            </label>

            <input
                type="text"
                name="nome"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Data
            </label>

            <input
                type="date"
                name="data"
                class="
                    w-full
                    border
                    rounded
                    p-2
                ">

        </div>

        <div class="mb-6">

            <label class="block mb-2 font-medium">
                Músicas
            </label>

            <div
                class="
                    border
                    rounded
                    p-4
                    max-h-64
                    overflow-y-auto
                ">

                @foreach($musicas as $musica)

                <div class="mb-2">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="musicas[]"
                            value="{{ $musica->id }}">

                        {{ $musica->titulo }}

                    </label>

                </div>

                @endforeach

            </div>

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection