<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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


    public function profile(){
        return view('recipes.profile');
    }

    public function solicitacoes(){
        // Busca todas as receitas (ou as específicas das solicitações)
        $recipes = Recipe::where('status', 'pending')->latest()->paginate(10); 

        // Passa a variável $recipes para a view
        return view('recipes.solicitacoes', compact('recipes'));
    }

    public function create(){
        $categorias = Category::all();
        return view('recipes.create', compact('categorias'));
    }
    
    public function store(Request $request)
    {
        $recipe = new Recipe; 
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
    /**
 * Deletar receita (apenas o dono ou admin)
 */

    /**
     * Formulário de editar receita
     */
    public function edit($id): View
    {
        $recipe = Recipe::findOrFail($id);
        
        // Verificar se é o dono ou admin
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Você não tem permissão para editar esta receita.');
        }
        
        // Não permitir editar receitas aprovadas
        if ($recipe->status === 'approved') {
            return redirect()
                ->route('profile.show')
                ->with('error', 'Receitas aprovadas não podem ser editadas.');
        }
        
        $categorias = Category::all();
        return view('recipes.edit', compact('recipe', 'categorias'));
    }

    /**
     * Atualizar receita
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $recipe = Recipe::findOrFail($id);
        
        // Verificar permissão
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Você não tem permissão para editar esta receita.');
        }
        
        // Não permitir editar receitas aprovadas
        if ($recipe->status === 'approved') {
            return redirect()
                ->route('profile.show')
                ->with('error', 'Receitas aprovadas não podem ser editadas.');
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'extra' => 'nullable|string',
        ]);

        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->extra_info = $request->extra;
        $recipe->category_id = $request->category_id;
        $recipe->status = 'approved'; // esta voltando como aprovado

        // Upload da nova imagem (se houver)
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Deletar imagem antiga
            if ($recipe->image) {
                $oldImagePath = public_path('img/recipes/' . $recipe->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            // Upload da nova imagem
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/recipes'), $imageName);
            $recipe->image = $imageName;
        }

        $recipe->save();
        
        return redirect()
            ->route('profile.show')
            ->with('success', 'Receita atualizada e enviada para aprovação!');
    }


    public function destroy($id): RedirectResponse
    {
        $recipe = Recipe::findOrFail($id);
        
        // Verificar se é o dono ou admin
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Você não tem permissão para excluir esta receita.');
        }
        
        // Deletar imagem se existir
        if ($recipe->image) {
            $imagePath = public_path('img/recipes/' . $recipe->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $recipe->delete();
        
        return redirect()
            ->route('profile.show')
            ->with('success', 'Receita excluída com sucesso!');
    }
}




     //public function create(){
        //return view('events.create')

