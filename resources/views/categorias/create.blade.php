<h1>Cadastrar Categoria</h1>

<form action="{{ route('categorias.store') }}" method="POST">

    @csrf

    <label>Nome: </label>
    <input type="text" name="nome">

    <button type="submit">
        Salvar
    </button>

</form>