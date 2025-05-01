<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RecipeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategoriesSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Don't use the default factory since our User model has different columns
        // User::factory(10)->create();
        
        // Call the recipe seeder to create sample recipes
        $this->call([
            UserSeeder::class,
            CategoriesSeeder::class,
            RecipeSeeder::class,
        ]);
    }
}
