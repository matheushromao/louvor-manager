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
            Categorias
        </h1>

        <a
            href="{{ route('categorias.create') }}"
            class="
                bg-blue-500
                text-white
                px-4
                py-2
                rounded
                hover:bg-blue-600
            "
        >
            Nova Categoria
        </a>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-100">

                <th class="text-left p-3">
                    Nome
                </th>

                <th class="text-left p-3">
                    Ações
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($categorias as $categoria)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $categoria->nome }}
                    </td>

                    <td
                        class="
                            p-3
                            flex
                            gap-2
                        "
                    >

                        <a
                            href="{{ route('categorias.edit', $categoria->id) }}"
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
                            action="{{ route('categorias.destroy', $categoria->id) }}"
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

        {{ $categorias->links() }}

    </div>

</div>

@endsection