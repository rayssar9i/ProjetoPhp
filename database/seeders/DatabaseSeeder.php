<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar as categorias base primeiro
    \App\Models\Category::create(['name' => 'Salgados']);
    \App\Models\Category::create(['name' => 'Doces']);
    \App\Models\Category::create(['name' => 'Massas']);
    \App\Models\Category::create(['name' => 'Sobremesas']);
    \App\Models\Category::create(['name' => 'Almoço']);

    // Criar um utilizador de teste para ser o autor
    \App\Models\User::factory()->create([
        'name' => 'Cozinheiro Teste',
        'email' => 'teste@exemplo.com',
    ]);

    // Agora sim, chamamos o Seeder de Receitas que criaste
    $this->call([
        RecipeSeeder::class,
    ]);
    }
}
