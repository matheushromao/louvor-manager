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

        </li>

    @endforeach

</ul>

{{ $musicas->links() }}

@endsection