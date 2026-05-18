<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeApprovalController extends Controller
{
    public function index(){//lista as receitas pendentes
        $recipes = Recipe::pending()
        ->with('author')
        ->latest()
        ->paginate('10');

        return view('manager.recipes.index', compact('recipes'));
    }

    public function show(Recipe $recipe){
        $recipe->load('author');
        return view('manager.recipes.show', compact('recipe'));
    }

    public function approve(Recipe $recipe){
        $recipe->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' =>now(),
            'rejection_reason' =>null
        ]);
        return redirect()
            ->route('manager.recipes.index')
            ->with('success', 'Receita aprovada com sucesso!');
    }

    public function reject(Request $request, Recipe $recipe){
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);
        $recipe->update([
            'status' =>'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'rejection_reason' =>$request->rejection_reason
        ]);

        return redirect()
            ->route('manager.recipes.index')
            ->with('success', 'Receita reprovada.');
    }
}
