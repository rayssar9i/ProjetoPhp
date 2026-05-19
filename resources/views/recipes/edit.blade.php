@extends('layouts.main')

@section('title', 'Editar Receita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create_recipe.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="form-main-title">Editar Receita</h2>

    @if($recipe->status === 'rejected')
        <div class="alert alert-warning mb-4">
            <strong>Sua receita foi rejeitada.</strong><br>
            Motivo: {{ $recipe->rejection_reason }}<br>
            Faça as correções necessárias e envie novamente.
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="image-upload-container">
                    <div class="image-placeholder" id="imagePreview">
                        @if($recipe->image)
                            <img src="{{ asset('img/recipes/' . $recipe->image) }}" 
                                 alt="{{ $recipe->title }}"
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">
                        @endif
                    </div>
                    <label for="image" class="btn-upload">
                        Alterar imagem <ion-icon name="cloud-upload-outline"></ion-icon>
                        <input type="file" id="image" name="image" hidden accept="image/*" onchange="previewImage(event)"> 
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-4">
                    <label class="form-label-custom">Título da receita</label>
                    <input type="text" 
                           name="title" 
                           class="form-input-custom" 
                           placeholder="Digite o Título"
                           value="{{ old('title', $recipe->title) }}"
                           required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Categorias</label>
                    <div class="category-options">
                        @foreach($categorias as $cat)
                            <div class="category-switch d-flex justify-content-between align-items-center mb-2 p-2 bg-white rounded-pill shadow-sm">
                                <span>{{ $cat->name }}</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="category_id" 
                                           value="{{ $cat->id }}" 
                                           id="cat_{{ $cat->id }}"
                                           {{ old('category_id', $recipe->category_id) == $cat->id ? 'checked' : '' }}
                                           required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label-custom">Ingredientes</label>
            <textarea name="ingredients" 
                      class="form-textarea-custom" 
                      placeholder="Digite um ingrediente por linha"
                      required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
            @error('ingredients')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label class="form-label-custom">Modo de Preparo</label>
            <textarea name="instructions" 
                      class="form-textarea-custom" 
                      placeholder="Digite o modo de preparo da receita"
                      required>{{ old('instructions', $recipe->instructions) }}</textarea>
            @error('instructions')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4 mb-5">
            <label class="form-label-custom">Mais informações</label>
            <textarea name="extra" 
                      class="form-textarea-custom">{{ old('extra', $recipe->extra_info) }}</textarea>
            @error('extra')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="d-flex gap-2 mb-5">
            <button type="submit" class="btn-publish">Salvar Alterações</button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px;">`;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection