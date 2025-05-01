<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create basic recipe categories
        $categories = [
            'Breakfast',
            'Lunch',
            'Dinner',
            'Dessert',
            'Appetizer',
            'Soup',
            'Salad',
            'Main Course',
            'Side Dish',
            'Snack',
            'Beverage',
            'Vegetarian',
            'Vegan',
            'Gluten-Free',
            'Dairy-Free'
        ];

        foreach ($categories as $category) {
            categories::create([
                'name' => $category
            ]);
        }
    }
}
