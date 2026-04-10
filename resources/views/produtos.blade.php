@extends('layouts.main')
@section('title', 'produtos')

@section('content')

    @if($busca != '')
        <p>o usuario esta buscando por: {{ $busca }}</p>
    @endif  

<h1>Pagina de produtos</h1>
@endsection