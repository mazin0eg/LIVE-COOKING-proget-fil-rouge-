<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\RecipeEquipment;
use Illuminate\Support\Facades\DB;

class ClearRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipes:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all recipes and related data from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing all recipes and related data...');

        // Use transactions for safety
        DB::beginTransaction();

        try {
            // Clear recipe relationships with categories
            DB::table('category_recipe')->truncate();
            
            // Clear recipe ingredients
            RecipeIngredient::truncate();
            
            // Clear recipe steps
            RecipeStep::truncate();
            
            // Clear recipe equipment
            RecipeEquipment::truncate();
            
            // Finally, clear recipes
            Recipe::truncate();
            
            DB::commit();
            $this->info('All recipes and related data have been cleared successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
