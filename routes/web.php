<?php

use Illuminate\Support\Facades\Route;

/*! Route::get('/', function () {
    return view('welcome');
});*/ 

use App\Http\Controllers\RecipeController;


Route::get('/', [RecipeController::class, 'index']) -> name('home');
Route::get('/perfil', [RecipeController::class, 'profile']) -> name('profile');
Route::get('/receita-exemplo', [RecipeController::class,'show']) -> name('recipe.show');
Route::get('/receita/criar', [RecipeController::class, 'create'])->name('recipes.create');

// Rota para mostrar o formulário
Route::get('/receita/criar', [RecipeController::class, 'create'])->name('recipes.create');

// Rota para RECEBER os dados (o formulário aponta para cá)
Route::post('/receita/guardar', [RecipeController::class, 'store'])->name('recipes.store');
// Rota para ver uma receita específica
Route::get('/receita/{id}', [RecipeController::class, 'show'])->name('recipes.show');
//listas de rotas, drirecionamento para as paginas, paginas estao na pasta resources/views, o nome da pagina tem que ser igual ao nome da rota, exemplo: /contact tem que ter uma pagina chamada contact.blade.php, e assim por diante.

?>