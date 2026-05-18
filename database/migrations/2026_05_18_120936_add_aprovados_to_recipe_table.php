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
        Schema::table('recipes', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])
            ->default('pending')
            ->after('instructions');

            $table->text('rejection_reason')
            ->nullable()
            ->after('status');

            $table->foreignId('approved_by')
            ->nullable()
            ->after('rejection_reason')
            ->constrained("users")
            ->onDelete('set null');

            $table->timestamp('approved_at')
            ->nullable()
            ->after('approved_by');
            //função que cria e organiza as colunas, o status de aprovação, a razao da rejeição , qm aprovou e qm foi aprovadoS
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipe', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'status',
                'rejection_reason',
                'approved_by',
                'approved_at'
            ]);
        });
    }
};
