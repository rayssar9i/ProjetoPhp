@extends('layouts.main')

@section('title', 'solicitacoes-gerente')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/solicitacoes.css') }}">
@endpush

<div class="container">
    <h1>Receitas Pendentes de Aprovação</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($recipes as $recipe)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="text-muted">
                            Por: {{ $recipe->author->name }} • 
                            {{ $recipe->created_at->diffForHumans() }}
                        </p>
                        <p class="card-text">
                            {{ Str::limit($recipe->description, 100) }}
                        </p>
                        <a href="{{ route('manager.recipes.show', $recipe) }}" 
                           class="btn btn-primary">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Nenhuma receita pendente!</p>
            </div>
        @endforelse
    </div>

    {{ $recipes->links() }}
</div>

