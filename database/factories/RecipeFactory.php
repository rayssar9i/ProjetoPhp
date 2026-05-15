<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'title' => fake()->sentence(3),
        'ingredients' => 'Ingrediente 1, Ingrediente 2',
        'instructions' => 'Passo 1, Passo 2',
        'user_id' => 1, // O ID do utilizador que criámos acima
        'category_id' => fake()->numberBetween(1, 5), // Escolhe uma das 5 categorias
        ];
    }
}
