<?php

use Illuminate\Support\Facades\Route;

/*! Route::get('/', function () {
    return view('welcome');
});*/ 

use App\Http\Controllers\SiteConttroller;

Route::get('/contact', [SiteConttroller::class, 'index']);
Route::get('/events/create', [SiteController::class, 'create']);

Route::get('/produtos', function(){

    $busca = request('search');

    return view('produtos', ['busca' => $busca]);
});

Route::get('/produto/{id}', function($id){ 
    return view('produto', ['id' => $id]);
})
//listas de rotas, drirecionamento para as paginas, paginas estao na pasta resources/views, o nome da pagina tem que ser igual ao nome da rota, exemplo: /contact tem que ter uma pagina chamada contact.blade.php, e assim por diante.

?>