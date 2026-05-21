@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow-md
        max-w-3xl
    "
>

    <h1
        class="
            text-2xl
            font-bold
            mb-6
        "
    >
        Novo Repertório
    </h1>

    <form
        action="{{ route('repertorios.store') }}"
        method="POST"
        class="space-y-6"
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

        <div>

            <x-label>
                Data
            </x-label>

            <x-input
                type="date"
                name="data"
                value="{{ old('data') }}"
            />

            <x-error field="data" />

        </div>

        <div>

            <x-label>
                Músicas
            </x-label>

            <div
                class="
                    border
                    border-gray-300
                    rounded-lg
                    p-4
                    max-h-72
                    overflow-y-auto
                "
            >

                @foreach($musicas as $musica)

                    <label
                        class="
                            flex
                            items-center
                            gap-2
                            mb-3
                        "
                    >

                        <input
                            type="checkbox"
                            name="musicas[]"
                            value="{{ $musica->id }}"
                        >

                        <span>

                            {{ $musica->titulo }}

                        </span>

                    </label>

                @endforeach

            </div>

            <x-error field="musicas" />

        </div>

        <x-button type="submit">
            Salvar
        </x-button>

    </form>

</div>

@endsection