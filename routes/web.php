<?php

use Illuminate\Support\Facades\Route;

/*! Route::get('/', function () {
    return view('welcome');
});*/ 

use App\Http\Controllers\RecipeController;


Route::get('/', [RecipeController::class, 'index']) -> name('home');
Route::get('/perfil', [RecipeController::class, 'profile']) -> name('profile');
Route::get('/receita-exemplo', [RecipeController::class,'show']) -> name('recipe.show');
//listas de rotas, drirecionamento para as paginas, paginas estao na pasta resources/views, o nome da pagina tem que ser igual ao nome da rota, exemplo: /contact tem que ter uma pagina chamada contact.blade.php, e assim por diante.

?>