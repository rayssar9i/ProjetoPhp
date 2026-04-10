@extends('layouts.main')
@section('title', 'pagina do produto')

@section('content')
<h1>Pagina de produtos</h1>

    @if($id != null )
        <p>O id do produto é: {{ $id }}</p> 
    @endif
@endsection 