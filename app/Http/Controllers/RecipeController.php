<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index() { 
        return view('recipes.home', [
            'categorias'=> Category::all(),
            'ultimas'=> Recipe::latest()->take(6)->get(),
            'almoco'=> Recipe::where('category_id', 5)->take(6)->get(),
            'Sobremesas'=> Recipe::where('category_id',4)->take(6)->get()
        ]);
    }

    // ELIMINEI A FUNÇÃO SHOW VAZIA QUE ESTAVA AQUI

    public function profile(){
        return view('recipes.profile');
    }

    public function create(){
        $categorias = Category::all();
        return view('recipes.create', compact('categorias'));
    }
    
    public function store(Request $request)
    {
        $recipe = new Recipe; // Como já tens o "use" lá em cima, não precisas do caminho completo
        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->extra_info = $request->extra;
        $recipe->category_id = $request->category_id;
        $recipe->user_id = 1; 

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/recipes'), $imageName);
            $recipe->image = $imageName;
        }

        $recipe->save();
        return redirect('/')->with('msg', 'Receita criada com sucesso!');
    }

    // MANTÉM APENAS ESTA VERSÃO DO SHOW:
    public function show($id) {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', ['recipe' => $recipe]);
    }
}



     //public function create(){
        //return view('events.create')

