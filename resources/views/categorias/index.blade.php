<h1>Lista de Categorias</h1>

<a href="{{ route('categorias.create') }}">
    Nova Categoria
</a>

<ul>

    @foreach($categorias as $categoria)

        <li>

            {{ $categoria->nome }}

            <a href="{{ route('categorias.edit', $categoria->id) }}">
                Editar
            </a>

            <form
                action="{{ route('categorias.destroy', $categoria->id) }}"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button type="submit">
                    Excluir
                </button>

            </form>

        </li>

    @endforeach

</ul>

{{ $categorias->links() }}