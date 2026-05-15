@extends('layouts.app')

@section('content')
<h1>Lista de Músicas</h1>

<a href="{{ route('musicas.create') }}">
    Nova Música
</a>

<ul>

    @foreach($musicas as $musica)

    <li>

        {{ $musica->titulo }}

        -

        {{ $musica->categoria->nome }}

        <a href="{{ route('musicas.edit', $musica->id) }}">
            Editar
        </a>

    </li>

    <form
        action="{{ route('musicas.destroy', $musica->id) }}"
        method="POST">

        @csrf
        @method('DELETE')

        <button type="submit">
            Excluir
        </button>

    </form>

    @endforeach

</ul>

{{ $musicas->links() }}

@endsection