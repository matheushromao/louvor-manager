<h1>Lista de Categorias</h1>

<ul>
    @foreach($categorias as $categoria)
        <li>{{ $categoria->nome }}</li>
    @endforeach
</ul>