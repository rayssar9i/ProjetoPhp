<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar o perfil do usuário (página customizada)
     */
    public function show(Request $request): View
    {
        $user = $request->user();
        
        // Buscar receitas do usuário
        $recipes = Recipe::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->paginate(12);
        
        // Estatísticas
        $stats = [
            'total' => Recipe::where('user_id', $user->id)->count(),
            'aprovadas' => Recipe::where('user_id', $user->id)->where('status', 'approved')->count(),
            'pendentes' => Recipe::where('user_id', $user->id)->where('status', 'pending')->count(),
            'rejeitadas' => Recipe::where('user_id', $user->id)->where('status', 'rejected')->count(),
        ];
        
        return view('profile.show', compact('user', 'recipes', 'stats'));
    }

    /**
     * Mostrar apenas as receitas do usuário
     */
    public function myRecipes(Request $request): View
    {
        $user = $request->user();
        
        $recipes = Recipe::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->paginate(15);
        
        return view('profile.recipes', compact('recipes'));
    }

    /**
     * Editar informações do perfil (Laravel Breeze)
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Atualizar informações do perfil
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Deletar conta do usuário
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}