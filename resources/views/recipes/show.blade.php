@extends('layouts.main')

@section('title', $recipe->title)

@section('content')
<div class="container mt-5">
    <h1>{{ $recipe->title }}</h1>
    <hr>
    <div class="row">
        <div class="col-md-6">
            @if($recipe->image)
                <img src="/img/recipes/{{ $recipe->image }}" class="img-fluid rounded" alt="{{ $recipe->title }}">
            @else
                <div style="background: #ddd; height: 300px; border-radius: 15px;"></div>
            @endif
        </div>
        <div class="col-md-6">
            <h3>Ingredientes</h3>
            <p>{{ $recipe->ingredients }}</p>
            
            <h3 class="mt-4">Modo de Preparo</h3>
            <p>{{ $recipe->instructions }}</p>
        </div>
    </div>
</div>
@endsection