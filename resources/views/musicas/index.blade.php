@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
    "
>

    <div
        class="
            flex
            justify-between
            items-center
            mb-6
        "
    >

        <h1 class="text-2xl font-bold">
            Músicas
        </h1>

        <a
            href="{{ route('musicas.create') }}"
            class="
                bg-blue-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-blue-600
            "
        >
            Nova Música
        </a>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-100">

                <th class="text-left p-3">
                    Título
                </th>

                <th class="text-left p-3">
                    Artista
                </th>

                <th class="text-left p-3">
                    Tom
                </th>

                <th class="text-left p-3">
                    Link do YouTube
                </th>

                <th class="text-left p-3">
                    Categoria
                </th>

                <th class="text-left p-3">
                    Ações
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($musicas as $musica)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $musica->titulo }}
                    </td>

                    <td class="p-3">
                        {{ $musica->artista }}
                    </td>

                    <td class="p-3">
                        {{ $musica->tom }}
                    </td>

                    <td class="p-3">
                        @if($musica->youtube_link)
                            <a
                                href="{{ $musica->youtube_link }}"
                                target="_blank"
                                class="
                                    bg-red-500
                                    hover:bg-red-600
                                    text-white
                                    px-3
                                    py-1
                                    rounded
                                "
                            >
                                YouTube
                            </a>
                        @else
                            <span class="text-gray-400">
                                Sem link
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        {{ $musica->categoria->nome }}
                    </td>

                    <td
                        class="
                            p-3
                            flex
                            gap-2
                        "
                    >

                        <a
                            href="{{ route('musicas.edit', $musica->id) }}"
                            class="
                                bg-yellow-500
                                text-white
                                px-3
                                py-1
                                rounded
                                hover:bg-yellow-600
                            "
                        >
                            Editar
                        </a>

                        <form
                            action="{{ route('musicas.destroy', $musica->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="
                                    bg-red-500
                                    text-white
                                    px-3
                                    py-1
                                    rounded
                                    hover:bg-red-600
                                "
                            >
                                Excluir
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="mt-6">

        {{ $musicas->links() }}

    </div>

</div>

@endsection