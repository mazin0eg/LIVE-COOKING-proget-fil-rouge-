<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{   
    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->unsignedBigInteger('user_id');
        $table->integer('prep_time')->default(0);
        $table->integer('cook_time')->default(0);
        $table->integer('servings')->default(1);
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        
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
