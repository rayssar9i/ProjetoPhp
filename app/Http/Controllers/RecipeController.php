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
        // 1. Validação (Garante que o banco não receba lixo)
    $request->validate([
        'title' => 'required|string|max:255',
        'ingredients' => 'required',
        'instructions' => 'required',
        'category_id' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $recipe = new Recipe;

    $recipe->title = $request->title;
    $recipe->ingredients = $request->ingredients;
    $recipe->instructions = $request->instructions;
    $recipe->category_id = $request->category_id;
    $recipe->user_id = 1; // Temporário: ID do seu usuário logado

    // 2. Upload da Imagem (se houver)
    if($request->hasFile('image') && $request->file('image')->isValid()) {
        $requestImage = $request->image;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
        // Move a imagem para public/img/recipes
        $requestImage->move(public_path('img/recipes'), $imageName);
        $recipe->image = $imageName;
    }

    // 3. SALVAR NO BANCO
    $recipe->save();

    return redirect('/')->with('msg', 'Receita enviada com sucesso!');
    }
    }



     //public function create(){
        //return view('events.create')

