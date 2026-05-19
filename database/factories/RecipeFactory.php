<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'ingredients' => 'Ingrediente 1, Ingrediente 2, Ingrediente 3',
            'instructions' => 'Passo 1: faça isso. Passo 2: faça aquilo.',
            'user_id' => User::inRandomOrder()->first()->id ?? 1, 
            'category_id' => fake()->numberBetween(1, 6), 
            'status' => 'pending', //Adicione o status
        ];
    }
}
