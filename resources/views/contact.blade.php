@extends('layouts.main')

@section('title', 'Pagina principal')

@section('content')
        
        <h1>Pagina de contato</h1>
<img src="{{ asset('img/banner.png') }}" class="w-32 h-auto rounded-full">

@if(30 > 10)
            <p>30 é maior que 10</p>
        @endif

       
        <p>{{ "Ola, ". $nome.", voce tem ". $idade." anos." }}</p>

        @foreach($array as $array)
            <p>{{ $array }}</p>
        @endforeach



        {{-- Comentário  invisivel haha--}}
    
@endsection
