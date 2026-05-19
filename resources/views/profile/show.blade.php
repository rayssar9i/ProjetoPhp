<!--@extends('layouts.main')

@section('title', 'Meu Perfil')

@section('content')
<div class="container mt-4">
    <h2>Perfil de {{ $user->name }}</h2>
    <p>E-mail: {{ $user->email }}</p>
    
    <hr>
    <h4>Suas Estatísticas</h4>
    <ul>
        <li>Total de Receitas: {{ $stats['total'] }}</li>
        <li>Aprovadas: {{ $stats['aprovadas'] }}</li>
        <li>Pendentes: {{ $stats['pendentes'] }}</li>
    </ul>
</div>
@endsection

-->
@extends('layouts.main')

@section('title', 'Meu Perfil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="profile-container">
    <!-- Header com Avatar e Info do Usuário -->
    <div class="profile-header">
        <div class="profile-avatar-container">
            <div class="profile-avatar">
                <img src="{{ asset('img/default-avatar.png') }}" alt="{{ $user->name }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="avatar-placeholder" style="display: none;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>
        </div>
        
        <div class="profile-info">
            <h1 class="profile-name">{{ $user->name }}</h1>
            <p class="profile-email">Cadastrado desde: {{ $user->created_at->format('d/m/Y') }}</p>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['total'] }}</span>
                    <span class="stat-label">Receitas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $stats['aprovadas'] }}</span>
                    <span class="stat-label">Receitas</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Receitas -->
    <div class="recipes-section">
        <h2 class="section-title">Minhas Receitas</h2>
        
        <div class="recipes-grid">
            @forelse($recipes as $recipe)
                <div class="recipe-card">
                    <div class="recipe-image">
                        @if($recipe->image)
                            <img src="{{ asset('img/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                        @else
                            <div class="recipe-placeholder"></div>
                        @endif
                        
                        <!-- Status Badge -->
                        @if($recipe->status === 'approved')
                            <span class="status-badge status-approved">Aprovada</span>
                        @elseif($recipe->status === 'pending')
                            <span class="status-badge status-pending">Pendente</span>
                        @else
                            <span class="status-badge status-rejected">Rejeitada</span>
                        @endif
                    </div>
                    
                    <div class="recipe-info">
                        <h3 class="recipe-title">{{ $recipe->title }}</h3>
                        
                        <div class="recipe-actions">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="action-btn" title="Ver receita">
                                <ion-icon name="eye-outline"></ion-icon>
                            </a>
                            @if($recipe->status !== 'approved')
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="action-btn" title="Editar">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                            @endif
                            <button onclick="confirmDelete({{ $recipe->id }})" class="action-btn" title="Excluir">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <ion-icon name="restaurant-outline"></ion-icon>
                    <h3>Você ainda não tem receitas!</h3>
                    <p>Comece criando sua primeira receita deliciosa.</p>
                    <a href="{{ route('recipes.create') }}" class="btn-create-recipe">
                        Criar Primeira Receita
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Paginação -->
        @if($recipes->hasPages())
            <div class="pagination-container">
                {{ $recipes->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir esta receita?</p>
                <p class="text-muted small">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(recipeId) {
    const form = document.getElementById('deleteForm');
    form.action = `/recipes/${recipeId}`;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection