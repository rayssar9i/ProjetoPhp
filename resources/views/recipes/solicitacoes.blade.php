@extends('layouts.main')

@section('title', 'Solicitações - Gerente')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/solicitacoes.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <h1>Receitas Pendentes de Aprovação</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($recipes as $recipe)
            <div class="col-md-6 mb-4">
                <div class="card">
                    @if($recipe->image)
                        <img src="{{ asset('img/recipes/' . $recipe->image) }}" 
                             class="card-img-top" 
                             alt="{{ $recipe->title }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div style="background: #ddd; height: 200px;"></div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        
                        <p class="text-muted mb-2">
                            <strong>Autor:</strong> {{ $recipe->author->name }} <br>
                            <strong>Enviado:</strong> {{ $recipe->created_at->diffForHumans() }}
                        </p>

                        <p class="card-text">
                            <strong>Ingredientes:</strong><br>
                            {{ Str::limit($recipe->ingredients, 100) }}
                        </p>

                        <div class="d-flex gap-2">
                            <a href="{{ route('recipes.show', $recipe->id) }}" 
                               class="btn btn-primary btn-sm">
                                Ver Detalhes
                            </a>

                            <form action="{{ route('manager.recipes.approve', $recipe) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Aprovar esta receita?')">
                                    ✓ Aprovar
                                </button>
                            </form>

                            <button type="button" 
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#rejectModal{{ $recipe->id }}">
                                ✗ Reprovar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Rejeição -->
            <div class="modal fade" 
                 id="rejectModal{{ $recipe->id }}" 
                 tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reprovar Receita</h5>
                            <button type="button" 
                                    class="btn-close" 
                                    data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('manager.recipes.reject', $recipe) }}" 
                              method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Motivo da reprovação:
                                    </label>
                                    <textarea name="rejection_reason" 
                                              class="form-control" 
                                              rows="3" 
                                              required
                                              placeholder="Explique o motivo da reprovação..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" 
                                        class="btn btn-secondary" 
                                        data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    Reprovar Receita
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4>🎉 Nenhuma receita pendente!</h4>
                    <p>Todas as receitas já foram analisadas.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center mt-4">
        {{ $recipes->links() }}
    </div>
</div>
@endsection

