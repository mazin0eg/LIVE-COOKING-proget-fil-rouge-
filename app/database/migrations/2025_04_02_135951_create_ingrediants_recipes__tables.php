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
        Schema::create('ingrediants_recipe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ingrediants_id');
            $table->unsignedBigInteger('recipe_id');
            $table->timestamps();

            $table->foreign('ingrediants_id')->references('id')->on('ingrediants')->onDelete('cascade');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            
            // Adding a unique constraint to prevent duplicate entries
            $table->unique(['ingrediants_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingrediants_recipe');
    }
};