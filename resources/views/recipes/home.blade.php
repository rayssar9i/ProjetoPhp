@extends('layouts.main')

@section('title', 'Página Principal')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    
    <div class="row mb-5">
        <div class="col-md-4"><div class="banner-box"></div></div>
        <div class="col-md-4"><div class="banner-box"></div></div>
        <div class="col-md-4"><div class="banner-box"></div></div>
    </div>

    <h5 class="section-title">Receitas mais buscadas</h5>
    <div class="d-flex justify-content-between mb-5 text-center">
        @foreach($categorias as $cat)
            <div class="category-item">
                <div class="category-circle"></div>
                <span>{{ $cat->name }}</span> 
            </div>
        @endforeach
    </div>

    <div class="recipe-section mb-5">
        <h5 class="section-title">Ultimas Receitas</h5>
        <div class="row g-3">
            @foreach($ultimas as $recipe)
                <div class="col-md-2 col-6">
                    <div class="card mini-recipe-card">
                        <div class="card-img-top recipe-thumb">
                            @if($recipe->image)
                                <img src="{{ asset('img/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                            @else
                                <div class="placeholder-thumb" style="background: #eee; height: 100%; border-radius: 10px;"></div>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                                <p class="card-text m-0 text-truncate">{{ $recipe->title }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="recipe-section mb-5">
        <h5 class="section-title">Receitas para o almoço</h5>
        <div class="row g-3">
            @foreach($almoco as $recipe)
                <div class="col-md-2 col-6">
                    <div class="card mini-recipe-card">
                        <div class="card-img-top recipe-thumb">
                            @if($recipe->image)
                                <img src="{{ asset('img/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                            @else
                                <div class="placeholder-thumb" style="background: #eee; height: 100%; border-radius: 10px;"></div>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                                <p class="card-text m-0 text-truncate">{{ $recipe->title }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class ="recipe-section mb-5">
        <h5 class ="section-title">Sobremesas</h5>
        <div class = "row g-3">
            @foreach($Sobremesas as $recipe)
          <div class="col-md-2 col-6">
                    <div class="card mini-recipe-card">
                        <div class="card-img-top recipe-thumb">
                            @if($recipe->image)
                                <img src="{{ asset('img/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                            @else
                                <div class="placeholder-thumb" style="background: #eee; height: 100%; border-radius: 10px;"></div>
                            @endif
                        </div>
                        <div class="card-body p-2 text-center">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                                <p class="card-text m-0 text-truncate">{{ $recipe->title }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div

</div>
@endsection('content') 