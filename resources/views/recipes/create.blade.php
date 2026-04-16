@extends('layouts.main')

@section('title', 'Envie Sua Receita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create_recipe.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="form-main-title">Envie Sua Receita</h2>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="image-upload-container">
                    <div class="image-placeholder"></div>
                    <label for="image" class="btn-upload">
                        Carregar imagem <ion-icon name="cloud-upload-outline"></ion-icon>
                        <input type="file" id="image" name="image" hidden>
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-4">
                    <label class="form-label-custom">Titulo da receita</label>
                    <input type="text" name="title" class="form-input-custom" placeholder="Digite o Titulo">
                </div>

               <div class="mb-4">
                    <label class="form-label-custom">Categorias</label>
                    <div class="category-options">
                        @foreach($categorias as $cat)
                            <div class="category-switch d-flex justify-content-between align-items-center mb-2 p-2 bg-white rounded-pill shadow-sm">
                                <span>{{ $cat->name }}</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="category_id" value="{{ $cat->id }}" id="cat_{{ $cat->id }}" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label-custom">Ingredientes</label>
            <textarea name="ingredients" class="form-textarea-custom" placeholder="Digite um ingrediente por linha"></textarea>
        </div>

        <div class="mt-4">
            <label class="form-label-custom">Modo de Preparo</label>
            <textarea name="instructions" class="form-textarea-custom" placeholder="Digite o modo de preparo da receita"></textarea>
        </div>

        <div class="mt-4 mb-5">
            <label class="form-label-custom">Mais informações</label>
            <textarea name="extra" class="form-textarea-custom"></textarea>
        </div>
        
        <button type="submit" class="btn-publish mb-5">Publicar Receita</button>
    </form>
</div>
@endsection