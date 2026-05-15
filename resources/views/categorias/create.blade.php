@extends('layouts.app')

@section('content')
<h1>Cadastrar Categoria</h1>

<form action="{{ route('categorias.store') }}" method="POST">

    @csrf

    <label>Nome: </label>

    <input
    type="text"
    name="nome"
    value="{{ old('nome') }}"
    >

    @error('nome')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit">
        Salvar
    </button>
</form>

@endsection