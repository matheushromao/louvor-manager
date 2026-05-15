<h1>Editar Categoria</h1>

<form
    action="{{ route('categorias.update', $categoria->id) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    <div>
        <label>Nome:</label>

        <input
            type="text"
            name="nome"
            value="{{ old('nome', $categoria->nome) }}"
        >

        @error('nome')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">
        Atualizar
    </button>

</form>