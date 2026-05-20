@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <h1
        class="
            text-3xl
            font-bold
        "
    >
        Dashboard
    </h1>

    <div
        class="
            grid
            grid-cols-1
            md:grid-cols-3
            gap-6
        "
    >

        <div
            class="
                bg-white
                p-6
                rounded-lg
                shadow
            "
        >

            <h2
                class="
                    text-gray-500
                    text-sm
                "
            >
                Total de Músicas
            </h2>

            <p
                class="
                    text-4xl
                    font-bold
                    mt-2
                "
            >
                {{ $totalMusicas }}
            </p>

        </div>

        <div
            class="
                bg-white
                p-6
                rounded-lg
                shadow
            "
        >

            <h2
                class="
                    text-gray-500
                    text-sm
                "
            >
                Total de Categorias
            </h2>

            <p
                class="
                    text-4xl
                    font-bold
                    mt-2
                "
            >
                {{ $totalCategorias }}
            </p>

        </div>

        <div
            class="
                bg-white
                p-6
                rounded-lg
                shadow
            "
        >

            <h2
                class="
                    text-gray-500
                    text-sm
                "
            >
                Total de Repertórios
            </h2>

            <p
                class="
                    text-4xl
                    font-bold
                    mt-2
                "
            >
                {{ $totalRepertorios }}
            </p>

        </div>

    </div>

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
                mb-4
            "
        >

            <h2
                class="
                    text-2xl
                    font-bold
                "
            >
                Últimos Repertórios
            </h2>

            <a
                href="{{ route('repertorios.index') }}"
                class="
                    text-blue-500
                    hover:underline
                "
            >
                Ver todos
            </a>

        </div>

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-3">
                        Nome
                    </th>

                    <th class="text-left py-3">
                        Data
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($ultimosRepertorios as $repertorio)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $repertorio->nome }}
                        </td>

                        <td class="py-3">
                            {{ \Carbon\Carbon::parse($repertorio->data)->format('d/m/Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="2"
                            class="
                                py-6
                                text-center
                                text-gray-500
                            "
                        >
                            Nenhum repertório encontrado.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection