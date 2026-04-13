<?php

use Illuminate\Support\Facades\Route;

/*! Route::get('/', function () {
    return view('welcome');
});*/ 

use App\Http\Controllers\SiteController;

Route::get('/contact', [SiteController::class, 'index']);
Route::get('/events/create', [SiteController::class, 'create']);

Route::get('/produtos', [SiteController::class, 'produtos']);

Route::get('/produto/{id}', [SiteController::class,'produto']);
//listas de rotas, drirecionamento para as paginas, paginas estao na pasta resources/views, o nome da pagina tem que ser igual ao nome da rota, exemplo: /contact tem que ter uma pagina chamada contact.blade.php, e assim por diante.

?>