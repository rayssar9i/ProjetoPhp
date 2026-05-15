<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('title', 100);
        $table->text('ingredients');
        $table->text('instructions'); // Mudei para o plural para bater com o Controller
        $table->string('image')->nullable(); // Adicionei para a foto da receita
        $table->text('extra_info')->nullable(); // Para o campo "Mais informações"
        
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
