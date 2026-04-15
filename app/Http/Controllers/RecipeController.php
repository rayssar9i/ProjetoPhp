<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index() {
    return view('recipes.home', [
        'categorias'=> \App\Models\Category::all(),
        'ultimas'=> \App\Models\Recipe::latest()->take(6)->get(),
        'almoco'=> \App\Models\Recipe::where('category_id', 1)->take(6)->get() // ID da categoria Almoço
    ]);
}

    public function show(){
        return view('recipes.show_recipe');
    }
    public function profile(){
        return view('recipes.profile');
    }
    public function create(){
        // Buscamos as categorias para aparecerem nos botões/switches do formulário
        $categorias = Category::all();

        // Retornamos a view que criaste para o formulário
        return view('recipes.create', compact('categorias'));
    }
    
    // Aproveita e já deixa pronta a função que vai RECEBER os dados do formulário:
    public function store(Request $request)
    {
    $recipe = new \App\Models\Recipe;

    $recipe->title = $request->title;
    $recipe->ingredients = $request->ingredients;
    $recipe->instructions = $request->instructions; // plural
    $recipe->extra_info = $request->extra; // mapeando 'extra' para 'extra_info' da migration
    
    // IMPORTANTE: Como o teu formulário não enviou category_id, 
    // vamos forçar o ID 1 para teste (garante que tens categorias no banco)
    $recipe->category_id = $request->category_id ?? 1;
    $recipe->user_id = 1; 

    // Upload da Imagem
    if($request->hasFile('image') && $request->file('image')->isValid()) {
        $requestImage = $request->image;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
        $requestImage->move(public_path('img/recipes'), $imageName);
        $recipe->image = $imageName;
    }

    $recipe->save(); // A ordem final para o PostgreSQL

    return redirect('/')->with('msg', 'Receita criada com sucesso!');
}
}



     //public function create(){
        //return view('events.create')

