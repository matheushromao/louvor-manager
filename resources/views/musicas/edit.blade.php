@extends('layouts.app')

@section('content')

<h1>Editar Música</h1>

<form
    action="{{ route('musicas.update', $musica->id) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    <div>

        <label>Título:</label>

        <input
            type="text"
            name="titulo"
            value="{{ old('titulo', $musica->titulo) }}"
        >

        @error('titulo')
            <p>{{ $message }}</p>
        @enderror

    </div>

    <br>

    <div>

        <label>Artista:</label>

        <input
            type="text"
            name="artista"
            value="{{ old('artista', $musica->artista) }}"
        >

        @error('artista')
            <p>{{ $message }}</p>
        @enderror

    </div>

    <br>

    <div>

        <label>Tom:</label>

        <input
            type="text"
            name="tom"
            value="{{ old('tom', $musica->tom) }}"
        >

        @error('tom')
            <p>{{ $message }}</p>
        @enderror

    </div>

    <br>

    <div>

        <label>Categoria:</label>

        <select name="categoria_id">

            @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}"

                    @selected(
                        old('categoria_id', $musica->categoria_id)
                        == $categoria->id
                    )
                >

                    {{ $categoria->nome }}

                </option>

            @endforeach

        </select>

        @error('categoria_id')
            <p>{{ $message }}</p>
        @enderror

    </div>

    <br>

    <button type="submit">
        Atualizar
    </button>

</form>

@endsection