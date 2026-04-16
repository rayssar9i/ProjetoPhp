<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    protected $fillable = ['id', 'name'];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar as categorias base primeiro
    \App\Models\Category::create([ 'id' =>1, 'name' => 'Salgados']);
    \App\Models\Category::create(['id'=>2,'name' => 'Doces']);
    \App\Models\Category::create(['id'=>3, 'name' => 'Massas']);
    \App\Models\Category::create(['id'=>4, 'name' => 'Sobremesas']);
    \App\Models\Category::create(['id'=>5,'name' => 'Almoço']);
    \App\Models\Category::create(['id'=> 6,'name'=> 'Dietas Restritivas']);

  
    \App\Models\User::create([
        'id' => 1,
        'name' => 'Admin',
        'email' => 'admin@teste.com',
        'password' => bcrypt('123456')
    ]);

    // Agora sim, chamamos o Seeder de Receitas que criaste
    $this->call([
        RecipeSeeder::class,
    ]);
    }
}
