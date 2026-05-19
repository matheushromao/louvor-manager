@extends('layouts.app')

@section('content')

<div
    class="
        bg-white
        p-6
        rounded-lg
        shadow
    ">

    <div
        class="
            flex
            justify-between
            items-center
            mb-6
        ">

        <h1 class="text-2xl font-bold">
            Repertórios
        </h1>

        <a
            href="{{ route('repertorios.create') }}"
            class="
                bg-blue-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-blue-600
            ">
            Novo Repertório
        </a>

    </div>

    <table class="w-full">

        <thead>

            <tr class="bg-gray-100">

                <th class="p-3 text-left">
                    Nome
                </th>

                <th class="p-3 text-left">
                    Data
                </th>

                <th class="p-3 text-left">
                    Músicas
                </th>

                <th class="p-3 text-left">
                    Ações
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($repertorios as $repertorio)

            <tr class="border-b">

                <td class="p-3">
                    {{ $repertorio->nome }}
                </td>

                <td class="p-3">
                    {{ $repertorio->data }}
                </td>

                <td class="p-3">

                    <div class="flex flex-wrap gap-2">

                        @foreach($repertorio->musicas as $musica)

                        <span
                            class="
                    bg-blue-100
                    text-blue-700
                    px-2
                    py-1
                    rounded
                    text-sm
                ">

                            {{ $musica->titulo }}

                        </span>

                        @endforeach

                    </div>

                </td>
                <td class="p-3 flex gap-2">

                    <a
                        href="{{ route('repertorios.edit', $repertorio->id) }}"
                        class="
                                bg-yellow-500
                                text-white
                                px-3
                                py-1
                                rounded
                            ">
                        Editar
                    </a>

                    <form
                        action="{{ route('repertorios.destroy', $repertorio->id) }}"
                        method="POST">

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
                                ">
                            Excluir
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="mt-6">

        {{ $repertorios->links() }}

    </div>

</div>

@endsection