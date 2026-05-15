@extends('layouts.app')

@section('content')
<h1>Cadastrar Música</h1>

<form action="{{ route('musicas.store') }}" method="POST">

    @csrf

    <div>
        <label>Título:</label>

        <input
            type="text"
            name="titulo"
            value="{{ old('titulo') }}"
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
            value="{{ old('artista') }}"
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
            value="{{ old('tom') }}"
        >

        @error('tom')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div>

        <label>Categoria:</label>

        <select name="categoria_id">

            <option value="">
                Selecione
            </option>

            @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}"
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
        Salvar
    </button>

</form>

@endsection