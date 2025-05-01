<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\RecipeEquipment;
use App\Models\User;
use App\Models\categories;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a chef user
        $chef = User::where('role', 'chef')->first();
        if (!$chef) {
            $chef = User::create([
                'first_name' => 'Chef',
                'last_name' => 'User',
                'email' => 'chef@example.com',
                'password' => bcrypt('password'),
                'role' => 'chef',
            ]);
        }
        
        // Get or create categories
        $mainCourse = categories::firstOrCreate(['name' => 'Main Course']);
        $appetizer = categories::firstOrCreate(['name' => 'Appetizer']);
        $dessert = categories::firstOrCreate(['name' => 'Dessert']);
        $breakfast = categories::firstOrCreate(['name' => 'Breakfast']);
        $soup = categories::firstOrCreate(['name' => 'Soup']);
        
        // Create recipes for different cuisines
        $this->createItalianRecipes($chef, $mainCourse, $appetizer, $dessert);
        $this->createJapaneseRecipes($chef, $mainCourse, $appetizer, $soup);
        $this->createMexicanRecipes($chef, $mainCourse, $appetizer);
        $this->createMoroccanRecipes($chef, $mainCourse, $soup);
        $this->createFrenchRecipes($chef, $mainCourse, $dessert);
        $this->createIndianRecipes($chef, $mainCourse, $appetizer);
        $this->createChineseRecipes($chef, $mainCourse, $soup);
        $this->createThaiRecipes($chef, $mainCourse, $soup);
        $this->createGreekRecipes($chef, $mainCourse, $appetizer);
        $this->createTurkishRecipes($chef, $mainCourse, $appetizer);
    }
    
    // Helper method to create a recipe with all related data
    private function createRecipe($data, $chef, $category, $ingredients, $steps, $equipment)
    {
        $recipe = Recipe::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $chef->id,
            'prep_time' => $data['prep_time'],
            'cook_time' => $data['cook_time'],
            'servings' => $data['servings'],
            'difficulty' => $data['difficulty'],
            'cuisine' => $data['cuisine'],
            'image_path' => $data['image_path'] ?? null,
            'category_id' => $category->id,
        ]);
        
        // Add ingredients
        foreach ($ingredients as $ingredient) {
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
                'unit' => $ingredient['unit'],
            ]);
        }
        
        // Add steps
        for ($i = 0; $i < count($steps); $i++) {
            RecipeStep::create([
                'recipe_id' => $recipe->id,
                'description' => $steps[$i],
                'order' => $i + 1,
            ]);
        }
        
        // Add equipment
        foreach ($equipment as $item) {
            RecipeEquipment::create([
                'recipe_id' => $recipe->id,
                'name' => $item,
            ]);
        }
        
        return $recipe;
    }
    
    // Cuisine-specific methods will be implemented separately
    private function createItalianRecipes($chef, $mainCourse, $appetizer, $dessert) {
        // Spaghetti Carbonara (Main Course)
        $carbonaraData = [
            'title' => 'Authentic Spaghetti Carbonara',
            'description' => 'A classic Roman pasta dish made with eggs, Pecorino Romano cheese, guanciale, and black pepper. No cream is used in the authentic version!',
            'prep_time' => 15,
            'cook_time' => 15,
            'servings' => 4,
            'difficulty' => 'medium',
            'cuisine' => 'Italian',
            'image_path' => 'recipe-images/carbonara.jpg',
        ];
        
        $carbonaraIngredients = [
            ['name' => 'Spaghetti', 'quantity' => '400', 'unit' => 'g'],
            ['name' => 'Guanciale (or Pancetta)', 'quantity' => '150', 'unit' => 'g'],
            ['name' => 'Egg Yolks', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Whole Egg', 'quantity' => '1', 'unit' => ''],
            ['name' => 'Pecorino Romano Cheese', 'quantity' => '50', 'unit' => 'g'],
            ['name' => 'Black Pepper', 'quantity' => '2', 'unit' => 'tsp'],
            ['name' => 'Salt', 'quantity' => '1', 'unit' => 'tsp'],
        ];
        
        $carbonaraSteps = [
            'Bring a large pot of salted water to a boil for the pasta.',
            'Cut the guanciale into small cubes or thin strips.',
            'In a bowl, whisk together the egg yolks, whole egg, grated Pecorino Romano, and plenty of freshly ground black pepper.',
            'In a large pan, cook the guanciale over medium heat until crispy and the fat has rendered, about 8-10 minutes.',
            'Meanwhile, cook the spaghetti in the boiling water until al dente (usually 1-2 minutes less than package instructions).',
            'Reserve 1/2 cup of pasta water, then drain the pasta.',
            'Remove the guanciale pan from heat and add the drained pasta, tossing quickly to coat in the fat.',
            'Quickly add the egg mixture to the hot pasta, stirring constantly. The residual heat will cook the eggs into a creamy sauce.',
            'If the sauce is too thick, add a splash of the reserved pasta water to loosen it.',
            'Serve immediately with extra grated cheese and black pepper on top.'
        ];
        
        $carbonaraEquipment = ['Large pot', 'Large frying pan', 'Mixing bowl', 'Whisk', 'Colander', 'Cheese grater'];
        
        $this->createRecipe($carbonaraData, $chef, $mainCourse, $carbonaraIngredients, $carbonaraSteps, $carbonaraEquipment);
        
        // Risotto ai Funghi Porcini (Main Course)
        $risottoData = [
            'title' => 'Risotto ai Funghi Porcini',
            'description' => 'A creamy northern Italian rice dish made with porcini mushrooms, white wine, and Parmesan cheese. The secret is in the slow addition of broth and constant stirring.',
            'prep_time' => 15,
            'cook_time' => 30,
            'servings' => 4,
            'difficulty' => 'medium',
            'cuisine' => 'Italian',
            'image_path' => 'recipe-images/risotto.jpg',
        ];
        
        $risottoIngredients = [
            ['name' => 'Arborio or Carnaroli Rice', 'quantity' => '320', 'unit' => 'g'],
            ['name' => 'Dried Porcini Mushrooms', 'quantity' => '30', 'unit' => 'g'],
            ['name' => 'Fresh Mushrooms', 'quantity' => '200', 'unit' => 'g'],
            ['name' => 'Onion', 'quantity' => '1', 'unit' => 'small'],
            ['name' => 'Garlic', 'quantity' => '2', 'unit' => 'cloves'],
            ['name' => 'Vegetable Broth', 'quantity' => '1', 'unit' => 'liter'],
            ['name' => 'Dry White Wine', 'quantity' => '100', 'unit' => 'ml'],
            ['name' => 'Butter', 'quantity' => '50', 'unit' => 'g'],
            ['name' => 'Parmesan Cheese', 'quantity' => '50', 'unit' => 'g'],
            ['name' => 'Extra Virgin Olive Oil', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Fresh Parsley', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Salt and Pepper', 'quantity' => '', 'unit' => 'to taste'],
        ];
        
        $risottoSteps = [
            'Soak the dried porcini mushrooms in warm water for 30 minutes. Strain and reserve the soaking liquid. Chop the rehydrated mushrooms.',
            'Clean and slice the fresh mushrooms.',
            'Finely chop the onion and garlic.',
            'In a large pot, heat the vegetable broth and keep it simmering.',
            'In a large, heavy-bottomed pan, heat the olive oil and half the butter. Add the onion and sauté until translucent.',
            'Add the garlic and cook for another minute.',
            'Add the fresh and rehydrated mushrooms, and cook until they release their moisture and begin to brown.',
            'Add the rice and toast it for 2-3 minutes, stirring constantly.',
            'Pour in the white wine and stir until it evaporates.',
            'Begin adding the hot broth one ladle at a time, stirring frequently. Add the mushroom soaking liquid (being careful to leave any grit behind).',
            'Continue adding broth and stirring until the rice is creamy but still al dente, about 18-20 minutes.',
            'Remove from heat and stir in the remaining butter and grated Parmesan cheese.',
            'Cover and let rest for 2 minutes.',
            'Garnish with chopped parsley and serve immediately.'
        ];
        
        $risottoEquipment = ['Large pot', 'Heavy-bottomed pan', 'Wooden spoon', 'Ladle', 'Cheese grater'];
        
        $this->createRecipe($risottoData, $chef, $mainCourse, $risottoIngredients, $risottoSteps, $risottoEquipment);
        
        // Bruschetta (Appetizer)
        $bruschettaData = [
            'title' => 'Classic Tomato Bruschetta',
            'description' => 'A simple and delicious Italian appetizer featuring toasted bread topped with fresh tomatoes, basil, garlic, and olive oil.',
            'prep_time' => 15,
            'cook_time' => 5,
            'servings' => 6,
            'difficulty' => 'easy',
            'cuisine' => 'Italian',
            'image_path' => 'recipe-images/bruschetta.jpg',
        ];
        
        $bruschettaIngredients = [
            ['name' => 'Crusty Italian Bread or Baguette', 'quantity' => '1', 'unit' => ''],
            ['name' => 'Ripe Tomatoes', 'quantity' => '6', 'unit' => 'medium'],
            ['name' => 'Fresh Basil Leaves', 'quantity' => '10', 'unit' => ''],
            ['name' => 'Garlic Cloves', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Extra Virgin Olive Oil', 'quantity' => '4', 'unit' => 'tbsp'],
            ['name' => 'Balsamic Vinegar', 'quantity' => '1', 'unit' => 'tbsp'],
            ['name' => 'Salt', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Black Pepper', 'quantity' => '1/4', 'unit' => 'tsp'],
        ];
        
        $bruschettaSteps = [
            'Preheat the oven to 425°F (220°C) or heat a grill pan.',
            'Slice the bread into 1/2-inch thick slices.',
            'Dice the tomatoes and place in a bowl.',
            'Chiffonade the basil leaves and add to the tomatoes.',
            'Mince one garlic clove and add to the tomato mixture.',
            'Add olive oil, balsamic vinegar, salt, and pepper to the tomato mixture and stir gently.',
            'Toast the bread slices in the oven or on the grill pan until golden brown, about 5 minutes.',
            'Cut the remaining garlic clove in half and rub the cut side on one side of each toasted bread slice.',
            'Top each bread slice with the tomato mixture.',
            'Drizzle with a little extra olive oil and serve immediately.'
        ];
        
        $bruschettaEquipment = ['Oven or grill pan', 'Mixing bowl', 'Knife', 'Cutting board'];
        
        $this->createRecipe($bruschettaData, $chef, $appetizer, $bruschettaIngredients, $bruschettaSteps, $bruschettaEquipment);
        
        // Tiramisu (Dessert)
        $tiramisuData = [
            'title' => 'Classic Tiramisu',
            'description' => 'A beloved Italian dessert made with layers of coffee-soaked ladyfingers and a rich mascarpone cream, dusted with cocoa powder.',
            'prep_time' => 30,
            'cook_time' => 0,
            'servings' => 8,
            'difficulty' => 'medium',
            'cuisine' => 'Italian',
            'image_path' => 'recipe-images/tiramisu.jpg',
        ];
        
        $tiramisuIngredients = [
            ['name' => 'Egg Yolks', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Granulated Sugar', 'quantity' => '150', 'unit' => 'g'],
            ['name' => 'Mascarpone Cheese', 'quantity' => '500', 'unit' => 'g'],
            ['name' => 'Strong Espresso Coffee (cooled)', 'quantity' => '300', 'unit' => 'ml'],
            ['name' => 'Ladyfinger Biscuits', 'quantity' => '200', 'unit' => 'g'],
            ['name' => 'Unsweetened Cocoa Powder', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Dark Rum or Marsala Wine (optional)', 'quantity' => '2', 'unit' => 'tbsp'],
        ];
        
        $tiramisuSteps = [
            'In a large bowl, beat the egg yolks with sugar until pale and creamy.',
            'Add the mascarpone cheese and gently fold until smooth and well combined.',
            'If using, add the rum or Marsala to the cooled coffee.',
            'Quickly dip each ladyfinger into the coffee mixture (don\'t soak them or they\'ll fall apart) and arrange in a single layer in a 9x13 inch dish.',
            'Spread half of the mascarpone mixture over the ladyfingers.',
            'Repeat with another layer of coffee-dipped ladyfingers and the remaining mascarpone mixture.',
            'Dust the top generously with cocoa powder.',
            'Cover and refrigerate for at least 4 hours, preferably overnight.',
            'Dust with additional cocoa powder just before serving if desired.'
        ];
        
        $tiramisuEquipment = ['Large mixing bowl', 'Electric mixer or whisk', 'Spatula', '9x13 inch dish', 'Sieve for cocoa powder'];
        
        $this->createRecipe($tiramisuData, $chef, $dessert, $tiramisuIngredients, $tiramisuSteps, $tiramisuEquipment);
    }
    
    private function createJapaneseRecipes($chef, $mainCourse, $appetizer, $soup) {
        // Tonkotsu Ramen (Main Course)
        $ramenData = [
            'title' => 'Tonkotsu Ramen',
            'description' => 'A rich, pork-based noodle soup that originated in Fukuoka, Japan. The broth is creamy white from boiling pork bones for many hours, creating a deep, complex flavor.',
            'prep_time' => 30,
            'cook_time' => 240,
            'servings' => 4,
            'difficulty' => 'hard',
            'cuisine' => 'Japanese',
            'image_path' => 'recipe-images/tonkotsu-ramen.jpg',
        ];
        
        $ramenIngredients = [
            ['name' => 'Pork Bones (preferably trotters and neck bones)', 'quantity' => '2', 'unit' => 'kg'],
            ['name' => 'Pork Belly', 'quantity' => '500', 'unit' => 'g'],
            ['name' => 'Ramen Noodles', 'quantity' => '400', 'unit' => 'g'],
            ['name' => 'Ginger', 'quantity' => '30', 'unit' => 'g'],
            ['name' => 'Garlic', 'quantity' => '1', 'unit' => 'head'],
            ['name' => 'Green Onions', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Soft-Boiled Eggs', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Soy Sauce', 'quantity' => '60', 'unit' => 'ml'],
            ['name' => 'Mirin', 'quantity' => '60', 'unit' => 'ml'],
            ['name' => 'Sake', 'quantity' => '60', 'unit' => 'ml'],
            ['name' => 'Sesame Oil', 'quantity' => '1', 'unit' => 'tbsp'],
            ['name' => 'Bean Sprouts', 'quantity' => '100', 'unit' => 'g'],
            ['name' => 'Nori Sheets', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Salt', 'quantity' => '', 'unit' => 'to taste'],
        ];
        
        $ramenSteps = [
            'Clean the pork bones by soaking in cold water for 1 hour, then rinse thoroughly.',
            'In a large pot, add the bones and cover with cold water. Bring to a boil and simmer for 5 minutes.',
            'Drain and rinse the bones to remove impurities. Clean the pot.',
            'Return the bones to the clean pot and add 5 liters of water. Bring to a boil, then reduce to a low simmer.',
            'Add the sliced ginger, crushed garlic cloves, and white parts of green onions to the broth.',
            'Simmer uncovered for at least 4 hours (preferably 6-8 hours), occasionally skimming off any scum that rises to the surface.',
            'For the chashu (pork belly): In a separate pot, combine soy sauce, mirin, sake, and 1 cup water. Add the pork belly and bring to a simmer.',
            'Cover and cook the pork belly on low heat for 2 hours, turning occasionally, until tender.',
            'For marinated eggs: Soft boil eggs for 6-7 minutes, then cool in ice water and peel. Marinate in some of the chashu cooking liquid for at least 2 hours.',
            'Strain the tonkotsu broth through a fine-mesh sieve.',
            'Season the broth with salt to taste.',
            'Cook the ramen noodles according to package instructions.',
            'To serve: Place cooked noodles in bowls, ladle hot broth over them. Top with sliced chashu, halved marinated egg, sliced green onions, bean sprouts, and a sheet of nori.',
            'Finish with a drizzle of sesame oil.'
        ];
        
        $ramenEquipment = ['Large stock pot', 'Fine-mesh sieve', 'Medium pot for chashu', 'Small pot for eggs', 'Ladle', 'Sharp knife'];
        
        $this->createRecipe($ramenData, $chef, $mainCourse, $ramenIngredients, $ramenSteps, $ramenEquipment);
        
        // Sushi Rolls (Main Course)
        $sushiData = [
            'title' => 'Homemade Sushi Rolls',
            'description' => 'Learn to make beautiful and delicious sushi rolls at home with this step-by-step recipe. Perfect for a special dinner or gathering with friends.',
            'prep_time' => 45,
            'cook_time' => 30,
            'servings' => 4,
            'difficulty' => 'medium',
            'cuisine' => 'Japanese',
            'image_path' => 'recipe-images/sushi-rolls.jpg',
        ];
        
        $sushiIngredients = [
            ['name' => 'Sushi Rice', 'quantity' => '2', 'unit' => 'cups'],
            ['name' => 'Water', 'quantity' => '2', 'unit' => 'cups'],
            ['name' => 'Rice Vinegar', 'quantity' => '3', 'unit' => 'tbsp'],
            ['name' => 'Sugar', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Salt', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Nori Sheets', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Sushi-Grade Salmon', 'quantity' => '200', 'unit' => 'g'],
            ['name' => 'Sushi-Grade Tuna', 'quantity' => '200', 'unit' => 'g'],
            ['name' => 'Avocado', 'quantity' => '1', 'unit' => 'large'],
            ['name' => 'Cucumber', 'quantity' => '1', 'unit' => 'medium'],
            ['name' => 'Wasabi Paste', 'quantity' => '2', 'unit' => 'tsp'],
            ['name' => 'Soy Sauce', 'quantity' => '60', 'unit' => 'ml'],
            ['name' => 'Pickled Ginger', 'quantity' => '50', 'unit' => 'g'],
        ];
        
        $sushiSteps = [
            'Rinse the sushi rice in cold water until the water runs clear. Drain well.',
            'Combine the rice and water in a medium saucepan. Bring to a boil, then reduce heat to low, cover, and simmer for 20 minutes.',
            'Remove from heat and let stand, covered, for 10 minutes.',
            'In a small saucepan, combine rice vinegar, sugar, and salt. Heat until sugar dissolves. Cool.',
            'Transfer the rice to a large wooden or glass bowl. Drizzle the vinegar mixture over the rice and fold gently with a rice paddle or wooden spoon to combine. Fan the rice as you fold to cool it quickly.',
            'Cover the rice with a damp cloth to prevent it from drying out.',
            'Prepare your fillings: slice the fish into long, thin strips. Cut avocado and cucumber into thin strips.',
            'Place a bamboo sushi mat on a clean work surface with the slats running horizontally. Place a sheet of plastic wrap on top of the mat (optional, but helps prevent sticking).',
            'Place a sheet of nori, shiny side down, on the mat.',
            'With wet hands, take a handful of rice and spread it evenly over the nori, leaving a 1-inch border at the top edge.',
            'Spread a small amount of wasabi in a line across the center of the rice.',
            'Arrange your fillings in a line across the center of the rice.',
            'Using the bamboo mat, roll the sushi away from you, applying gentle pressure to create a compact roll. Use the border without rice to seal the roll.',
            'With a sharp, wet knife, slice the roll into 6-8 pieces.',
            'Serve with soy sauce, wasabi, and pickled ginger.'
        ];
        
        $sushiEquipment = ['Rice cooker or saucepan', 'Bamboo sushi mat', 'Sharp knife', 'Wooden or glass bowl', 'Rice paddle or wooden spoon'];
        
        $this->createRecipe($sushiData, $chef, $mainCourse, $sushiIngredients, $sushiSteps, $sushiEquipment);
        
        // Miso Soup (Soup)
        $misoData = [
            'title' => 'Traditional Miso Soup',
            'description' => 'A comforting Japanese soup made with dashi stock and miso paste. Simple yet packed with umami flavor, this soup is a staple in Japanese cuisine.',
            'prep_time' => 10,
            'cook_time' => 15,
            'servings' => 4,
            'difficulty' => 'easy',
            'cuisine' => 'Japanese',
            'image_path' => 'recipe-images/miso-soup.jpg',
        ];
        
        $misoIngredients = [
            ['name' => 'Dashi Stock (or 4 cups water + dashi powder)', 'quantity' => '1', 'unit' => 'liter'],
            ['name' => 'Miso Paste (preferably awase/mixed miso)', 'quantity' => '4', 'unit' => 'tbsp'],
            ['name' => 'Tofu (firm)', 'quantity' => '200', 'unit' => 'g'],
            ['name' => 'Wakame Seaweed (dried)', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Green Onions', 'quantity' => '2', 'unit' => ''],
        ];
        
        $misoSteps = [
            'If using dried wakame, soak it in cold water for 5 minutes until rehydrated, then drain.',
            'Cut the tofu into 1/2-inch cubes.',
            'Thinly slice the green onions.',
            'In a medium saucepan, bring the dashi stock to a simmer over medium heat. Do not boil.',
            'Place the miso paste in a small bowl. Add a ladleful of hot dashi and whisk until the miso is dissolved.',
            'Pour the miso mixture back into the saucepan with the remaining dashi. Stir gently.',
            'Add the tofu cubes and wakame. Simmer for 2 minutes, but do not boil (boiling will destroy the flavor and aroma of the miso).',
            'Remove from heat and garnish with sliced green onions.',
            'Serve immediately.'
        ];
        
        $misoEquipment = ['Medium saucepan', 'Small bowl', 'Whisk', 'Ladle'];
        
        $this->createRecipe($misoData, $chef, $soup, $misoIngredients, $misoSteps, $misoEquipment);
        
        // Gyoza (Appetizer)
        $gyozaData = [
            'title' => 'Japanese Gyoza Dumplings',
            'description' => 'Crispy on the bottom and juicy inside, these Japanese dumplings are filled with a savory mixture of ground pork, cabbage, and seasonings.',
            'prep_time' => 45,
            'cook_time' => 15,
            'servings' => 6,
            'difficulty' => 'medium',
            'cuisine' => 'Japanese',
            'image_path' => 'recipe-images/gyoza.jpg',
        ];
        
        $gyozaIngredients = [
            ['name' => 'Gyoza Wrappers', 'quantity' => '40', 'unit' => ''],
            ['name' => 'Ground Pork', 'quantity' => '500', 'unit' => 'g'],
            ['name' => 'Cabbage', 'quantity' => '300', 'unit' => 'g'],
            ['name' => 'Green Onions', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Garlic', 'quantity' => '3', 'unit' => 'cloves'],
            ['name' => 'Ginger', 'quantity' => '1', 'unit' => 'tbsp'],
            ['name' => 'Soy Sauce', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Sesame Oil', 'quantity' => '1', 'unit' => 'tbsp'],
            ['name' => 'Salt', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'White Pepper', 'quantity' => '1/4', 'unit' => 'tsp'],
            ['name' => 'Vegetable Oil', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Water', 'quantity' => '100', 'unit' => 'ml'],
            ['name' => 'For Dipping Sauce:', 'quantity' => '', 'unit' => ''],
            ['name' => 'Soy Sauce', 'quantity' => '60', 'unit' => 'ml'],
            ['name' => 'Rice Vinegar', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Chili Oil (optional)', 'quantity' => '1', 'unit' => 'tsp'],
        ];
        
        $gyozaSteps = [
            'Finely chop the cabbage and place it in a colander. Sprinkle with 1/2 teaspoon salt and let sit for 15 minutes to draw out moisture.',
            'Squeeze the cabbage firmly to remove excess water.',
            'Finely chop the green onions, garlic, and ginger.',
            'In a large bowl, combine the ground pork, drained cabbage, green onions, garlic, ginger, soy sauce, sesame oil, and white pepper. Mix well with your hands until sticky.',
            'Place a gyoza wrapper in your palm and add about 1 tablespoon of filling to the center.',
            'Moisten the edge of the wrapper with water using your fingertip.',
            'Fold the wrapper in half over the filling and pinch the center together.',
            'Create pleats on one side of the wrapper, pressing them against the flat side to seal the dumpling.',
            'Repeat with remaining wrappers and filling.',
            'Heat vegetable oil in a large non-stick skillet over medium-high heat.',
            'Place the gyoza flat-side down in the skillet, fitting as many as possible without touching.',
            'Fry until the bottoms are golden brown, about 3 minutes.',
            'Add water to the skillet and immediately cover with a lid. Reduce heat to medium and steam for about 3 minutes until the water has evaporated.',
            'Remove the lid and continue cooking for another minute to crisp up the bottoms again.',
            'For the dipping sauce, combine soy sauce, rice vinegar, and chili oil if using.',
            'Serve gyoza hot with the dipping sauce.'
        ];
        
        $gyozaEquipment = ['Large mixing bowl', 'Non-stick skillet with lid', 'Colander', 'Cutting board', 'Knife'];
        
        $this->createRecipe($gyozaData, $chef, $appetizer, $gyozaIngredients, $gyozaSteps, $gyozaEquipment);
    }
    
    private function createMexicanRecipes($chef, $mainCourse, $appetizer) {
        // Authentic Beef Tacos (Main Course)
        $tacosData = [
            'title' => 'Authentic Beef Tacos',
            'description' => 'Traditional Mexican tacos with seasoned beef, fresh toppings, and homemade salsa. Served on soft corn tortillas for an authentic taste of Mexico.',
            'prep_time' => 20,
            'cook_time' => 30,
            'servings' => 6,
            'difficulty' => 'medium',
            'cuisine' => 'Mexican',
            'image_path' => 'recipe-images/beef-tacos.jpg',
        ];
        
        $tacosIngredients = [
            ['name' => 'Corn Tortillas', 'quantity' => '12', 'unit' => ''],
            ['name' => 'Beef Skirt or Flank Steak', 'quantity' => '750', 'unit' => 'g'],
            ['name' => 'White Onion', 'quantity' => '1', 'unit' => 'large'],
            ['name' => 'Garlic', 'quantity' => '4', 'unit' => 'cloves'],
            ['name' => 'Lime', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Fresh Cilantro', 'quantity' => '1', 'unit' => 'bunch'],
            ['name' => 'Cumin', 'quantity' => '2', 'unit' => 'tsp'],
            ['name' => 'Dried Oregano', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Chili Powder', 'quantity' => '1', 'unit' => 'tbsp'],
            ['name' => 'Vegetable Oil', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Salt', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Black Pepper', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'For Toppings:', 'quantity' => '', 'unit' => ''],
            ['name' => 'Radishes', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Avocado', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Queso Fresco or Cotija Cheese', 'quantity' => '100', 'unit' => 'g'],
            ['name' => 'Salsa Verde or Roja', 'quantity' => '1', 'unit' => 'cup'],
        ];
        
        $tacosSteps = [
            'Slice the beef against the grain into thin strips.',
            'In a bowl, mix cumin, oregano, chili powder, minced garlic, salt, and pepper.',
            'Add the beef to the spice mixture and toss to coat. Add the juice of one lime and mix well.',
            'Heat oil in a large skillet over high heat until smoking.',
            'Cook the beef in batches, without overcrowding, for about 3-4 minutes until browned and slightly crispy on the edges.',
            'Transfer to a plate and cover with foil to keep warm.',
            'Dice the onion and chop the cilantro.',
            'Warm the corn tortillas on a dry skillet or directly over a gas flame for about 30 seconds per side.',
            'To assemble: place beef on each tortilla, top with diced onion, cilantro, sliced radishes, crumbled cheese, and avocado slices.',
            'Serve with lime wedges and salsa on the side.'
        ];
        
        $tacosEquipment = ['Large skillet', 'Mixing bowl', 'Cutting board', 'Sharp knife', 'Tongs'];
        
        $this->createRecipe($tacosData, $chef, $mainCourse, $tacosIngredients, $tacosSteps, $tacosEquipment);
        
        // Chicken Enchiladas (Main Course)
        $enchiladasData = [
            'title' => 'Chicken Enchiladas with Red Sauce',
            'description' => 'Corn tortillas filled with shredded chicken, smothered in a rich red chile sauce, and topped with melted cheese. A classic Mexican comfort food.',
            'prep_time' => 30,
            'cook_time' => 45,
            'servings' => 6,
            'difficulty' => 'medium',
            'cuisine' => 'Mexican',
            'image_path' => 'recipe-images/enchiladas.jpg',
        ];
        
        $enchiladasIngredients = [
            ['name' => 'Corn Tortillas', 'quantity' => '12', 'unit' => ''],
            ['name' => 'Chicken Breasts', 'quantity' => '750', 'unit' => 'g'],
            ['name' => 'Dried Guajillo Chiles', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Dried Ancho Chiles', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Garlic', 'quantity' => '4', 'unit' => 'cloves'],
            ['name' => 'White Onion', 'quantity' => '1', 'unit' => 'medium'],
            ['name' => 'Tomatoes', 'quantity' => '2', 'unit' => 'medium'],
            ['name' => 'Chicken Broth', 'quantity' => '2', 'unit' => 'cups'],
            ['name' => 'Cumin', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Dried Oregano', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Vegetable Oil', 'quantity' => '3', 'unit' => 'tbsp'],
            ['name' => 'Monterey Jack or Queso Chihuahua', 'quantity' => '300', 'unit' => 'g'],
            ['name' => 'Sour Cream', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Fresh Cilantro', 'quantity' => '1/4', 'unit' => 'cup'],
            ['name' => 'Salt', 'quantity' => '', 'unit' => 'to taste'],
        ];
        
        $enchiladasSteps = [
            'Poach the chicken: Place chicken breasts in a pot, cover with water, add salt, and simmer for 20 minutes until cooked through.',
            'Remove chicken, let cool, then shred with two forks. Reserve 2 cups of the cooking liquid.',
            'For the sauce: Remove stems and seeds from dried chiles. Toast them in a dry skillet for 1-2 minutes until fragrant.',
            'Place toasted chiles in a bowl and cover with hot water. Let soak for 20 minutes until soft.',
            'In the same skillet, roast the tomatoes and half the onion until charred. Add garlic for the last minute.',
            'Drain the chiles and place in a blender with the roasted vegetables, cumin, oregano, and 1 cup of chicken broth. Blend until smooth.',
            'Heat 2 tablespoons oil in a saucepan over medium heat. Strain the sauce into the pan and simmer for 15 minutes, adding more broth if too thick.',
            'In a separate pan, heat 1 tablespoon oil and briefly fry each tortilla for about 10 seconds per side to soften (or microwave them wrapped in damp paper towels).',
            'Dip each tortilla in the warm sauce, fill with shredded chicken, and roll up.',
            'Place enchiladas seam-side down in a baking dish. Pour remaining sauce over top and sprinkle with cheese.',
            'Bake at 375°F (190°C) for 15-20 minutes until cheese is melted and bubbly.',
            'Garnish with diced onion, cilantro, and a drizzle of sour cream.'
        ];
        
        $enchiladasEquipment = ['Large pot', 'Skillet', 'Blender', 'Baking dish', 'Tongs', 'Strainer'];
        
        $this->createRecipe($enchiladasData, $chef, $mainCourse, $enchiladasIngredients, $enchiladasSteps, $enchiladasEquipment);
        
        // Guacamole (Appetizer)
        $guacamoleData = [
            'title' => 'Authentic Mexican Guacamole',
            'description' => 'A classic Mexican dip made with ripe avocados, lime juice, cilantro, and just the right amount of heat. Perfect with tortilla chips or as a topping for tacos.',
            'prep_time' => 15,
            'cook_time' => 0,
            'servings' => 6,
            'difficulty' => 'easy',
            'cuisine' => 'Mexican',
            'image_path' => 'recipe-images/guacamole.jpg',
        ];
        
        $guacamoleIngredients = [
            ['name' => 'Ripe Avocados', 'quantity' => '4', 'unit' => 'large'],
            ['name' => 'Lime', 'quantity' => '1', 'unit' => ''],
            ['name' => 'Red Onion', 'quantity' => '1/4', 'unit' => 'cup'],
            ['name' => 'Fresh Cilantro', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Jalapeño or Serrano Pepper', 'quantity' => '1', 'unit' => ''],
            ['name' => 'Roma Tomato', 'quantity' => '1', 'unit' => 'medium'],
            ['name' => 'Garlic', 'quantity' => '1', 'unit' => 'clove'],
            ['name' => 'Salt', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Tortilla Chips', 'quantity' => '', 'unit' => 'for serving'],
        ];
        
        $guacamoleSteps = [
            'Cut the avocados in half, remove the pits, and scoop the flesh into a bowl.',
            'Mash the avocados with a fork, leaving some chunks for texture.',
            'Finely dice the red onion and tomato. Mince the garlic and jalapeño (remove seeds for less heat).',
            'Chop the cilantro leaves.',
            'Add the diced onion, tomato, garlic, jalapeño, and cilantro to the mashed avocados.',
            'Squeeze the lime juice over the mixture and add salt.',
            'Gently stir to combine all ingredients, being careful not to over-mix.',
            'Taste and adjust seasoning if needed.',
            'Serve immediately with tortilla chips, or place plastic wrap directly on the surface of the guacamole and refrigerate briefly to prevent browning.'
        ];
        
        $guacamoleEquipment = ['Mixing bowl', 'Fork', 'Cutting board', 'Knife'];
        
        $this->createRecipe($guacamoleData, $chef, $appetizer, $guacamoleIngredients, $guacamoleSteps, $guacamoleEquipment);
        
        // Salsa Roja (Appetizer)
        $salsaData = [
            'title' => 'Roasted Tomato Salsa Roja',
            'description' => 'A vibrant, smoky Mexican salsa made with roasted tomatoes, chiles, and garlic. Perfect for dipping chips or topping your favorite Mexican dishes.',
            'prep_time' => 10,
            'cook_time' => 15,
            'servings' => 8,
            'difficulty' => 'easy',
            'cuisine' => 'Mexican',
            'image_path' => 'recipe-images/salsa-roja.jpg',
        ];
        
        $salsaIngredients = [
            ['name' => 'Roma Tomatoes', 'quantity' => '6', 'unit' => ''],
            ['name' => 'Jalapeño or Serrano Peppers', 'quantity' => '2', 'unit' => ''],
            ['name' => 'White Onion', 'quantity' => '1/2', 'unit' => ''],
            ['name' => 'Garlic', 'quantity' => '3', 'unit' => 'cloves'],
            ['name' => 'Fresh Cilantro', 'quantity' => '1/4', 'unit' => 'cup'],
            ['name' => 'Lime', 'quantity' => '1', 'unit' => ''],
            ['name' => 'Salt', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Cumin', 'quantity' => '1/4', 'unit' => 'tsp'],
            ['name' => 'Tortilla Chips', 'quantity' => '', 'unit' => 'for serving'],
        ];
        
        $salsaSteps = [
            'Preheat the broiler to high.',
            'Place the whole tomatoes, jalapeños, onion half, and unpeeled garlic cloves on a baking sheet.',
            'Broil for 10-15 minutes, turning occasionally, until vegetables are charred on all sides.',
            'Remove from oven and let cool slightly.',
            'Peel the garlic cloves and remove stems from the jalapeños. For a milder salsa, remove seeds and membranes from the jalapeños.',
            'Place the roasted vegetables in a blender or food processor.',
            'Add cilantro, lime juice, salt, and cumin.',
            'Pulse until you reach your desired consistency (chunky or smooth).',
            'Taste and adjust seasoning if needed.',
            'Let cool completely before serving with tortilla chips.'
        ];
        
        $salsaEquipment = ['Baking sheet', 'Blender or food processor', 'Knife', 'Cutting board'];
        
        $this->createRecipe($salsaData, $chef, $appetizer, $salsaIngredients, $salsaSteps, $salsaEquipment);
    }
    
    private function createMoroccanRecipes($chef, $mainCourse, $soup) {
        // Moroccan Harira Soup (Soup)
        $hariraData = [
            'title' => 'Moroccan Harira Soup',
            'description' => 'A hearty traditional Moroccan soup with lentils, chickpeas, tomatoes, and fragrant spices. Typically served during Ramadan to break the fast, but enjoyed year-round as a comforting meal.',
            'prep_time' => 30,
            'cook_time' => 60,
            'servings' => 6,
            'difficulty' => 'medium',
            'cuisine' => 'Moroccan',
            'image_path' => 'recipe-images/harira-soup.jpg',
        ];
        
        $hariraIngredients = [
            ['name' => 'Lamb or beef, diced (Lham)', 'quantity' => '300', 'unit' => 'g'],
            ['name' => 'Onion, finely chopped (Basla)', 'quantity' => '1', 'unit' => 'large'],
            ['name' => 'Celery stalks, chopped (Krafess)', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Tomatoes, diced (Maticha)', 'quantity' => '4', 'unit' => 'medium'],
            ['name' => 'Tomato paste (Concentré de Maticha)', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Chickpeas, soaked overnight and drained (Hommos)', 'quantity' => '1', 'unit' => 'cup'],
            ['name' => 'Brown lentils (L\'adess)', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Rice (Roz)', 'quantity' => '1/4', 'unit' => 'cup'],
            ['name' => 'Fresh cilantro, chopped (Qsbour)', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Fresh parsley, chopped (Maadnous)', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Flour (Dqiq)', 'quantity' => '3', 'unit' => 'tbsp'],
            ['name' => 'Ground cinnamon (Qarfa)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Ground ginger (Skinjbir)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Ground turmeric (Kharkoum)', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Ground black pepper (Ibzar)', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Olive oil (Zit Zitoune)', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Salt (Melha)', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Lemon wedges (Hamd)', 'quantity' => '1', 'unit' => 'for serving'],
            ['name' => 'Dates (Tmar)', 'quantity' => '6', 'unit' => 'for serving'],
        ];
        
        $hariraSteps = [
            'In a large pot, heat olive oil over medium heat. Add the meat and brown on all sides (about 5 minutes).',
            'Add the chopped onion and celery, and sauté until soft (about 3-4 minutes).',
            'Add the tomatoes, tomato paste, chickpeas, lentils, cinnamon, ginger, turmeric, black pepper, and salt. Stir well to combine.',
            'Pour in 8 cups of water, bring to a boil, then reduce heat to low. Cover and simmer for 45 minutes, or until the meat and legumes are tender.',
            'Add the rice and continue to cook for another 15 minutes until the rice is tender.',
            'In a small bowl, mix the flour with 1 cup of water until smooth with no lumps.',
            'Slowly pour the flour mixture into the soup while stirring constantly to prevent lumps.',
            'Add the chopped cilantro and parsley, and simmer for another 5 minutes until the soup thickens slightly.',
            'Taste and adjust seasoning if needed.',
            'Serve hot with lemon wedges and dates on the side, as traditionally done during Ramadan (Shehiwat Ramadan).'
        ];
        
        $hariraEquipment = ['Large pot', 'Wooden spoon', 'Measuring cups and spoons', 'Sharp knife', 'Cutting board', 'Small bowl for flour mixture'];
        
        $this->createRecipe($hariraData, $chef, $soup, $hariraIngredients, $hariraSteps, $hariraEquipment);
        
        // Moroccan Chicken Tagine with Preserved Lemon and Olives (Main Course)
        $chickenTagineData = [
            'title' => 'Chicken Tagine with Preserved Lemon and Olives',
            'description' => 'A classic Moroccan dish featuring tender chicken cooked with preserved lemons, olives, and aromatic spices. The combination of savory, tangy, and slightly bitter flavors creates a truly authentic Moroccan experience.',
            'prep_time' => 20,
            'cook_time' => 60,
            'servings' => 4,
            'difficulty' => 'medium',
            'cuisine' => 'Moroccan',
            'image_path' => 'recipe-images/chicken-tagine.jpg',
        ];
        
        $chickenTagineIngredients = [
            ['name' => 'Chicken pieces, preferably thighs and legs (Djaj)', 'quantity' => '1.5', 'unit' => 'kg'],
            ['name' => 'Onions, thinly sliced (Basla)', 'quantity' => '2', 'unit' => 'medium'],
            ['name' => 'Garlic cloves, minced (Touma)', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Preserved lemons, quartered (L\'hamd Markad)', 'quantity' => '2', 'unit' => ''],
            ['name' => 'Green olives, pitted (Zitoun)', 'quantity' => '1', 'unit' => 'cup'],
            ['name' => 'Fresh cilantro, chopped (Qsbour)', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Fresh parsley, chopped (Maadnous)', 'quantity' => '1/2', 'unit' => 'cup'],
            ['name' => 'Ground ginger (Skinjbir)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Ground turmeric (Kharkoum)', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Ground cumin (Kamoun)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Paprika (Felfla Hamra)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Saffron threads, soaked in warm water (Zafran)', 'quantity' => '1', 'unit' => 'pinch'],
            ['name' => 'Olive oil (Zit Zitoune)', 'quantity' => '3', 'unit' => 'tbsp'],
            ['name' => 'Salt (Melha)', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Black pepper (Ibzar)', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Water (Ma)', 'quantity' => '1', 'unit' => 'cup'],
        ];
        
        $chickenTagineSteps = [
            'Rinse the preserved lemons, remove the pulp, and slice the rinds into thin strips. Set aside.',
            'In a large bowl, mix the chicken pieces with half of the chopped cilantro and parsley, minced garlic, ginger, turmeric, cumin, paprika, salt, and pepper. Let marinate for at least 30 minutes (or overnight in the refrigerator for best results).',
            'Heat olive oil in a tagine pot or heavy-bottomed Dutch oven over medium heat.',
            'Add the sliced onions and cook until soft and translucent, about 5 minutes.',
            'Add the marinated chicken pieces and brown on all sides, about 5 minutes.',
            'Pour in the water and saffron with its soaking liquid. Bring to a simmer.',
            'Reduce heat to low, cover, and simmer for about 45 minutes, or until the chicken is tender and cooked through.',
            'Add the preserved lemon strips and olives, and continue cooking for another 15 minutes.',
            'Taste and adjust seasoning if needed.',
            'Garnish with the remaining fresh cilantro and parsley before serving.',
            'Traditionally served with warm Moroccan bread (Khobz) or couscous to soak up the flavorful sauce (Marka).'
        ];
        
        $chickenTagineEquipment = ['Tagine pot or Dutch oven', 'Large bowl for marinating', 'Sharp knife', 'Cutting board', 'Measuring spoons'];
        
        $this->createRecipe($chickenTagineData, $chef, $mainCourse, $chickenTagineIngredients, $chickenTagineSteps, $chickenTagineEquipment);
        
        // Moroccan Lamb Tagine with Prunes
        $tagineData = [
            'title' => 'Moroccan Lamb Tagine with Prunes',
            'description' => 'A traditional Moroccan slow-cooked stew made with tender lamb, sweet prunes, and aromatic spices. Served with couscous, this dish is perfect for special occasions.',
            'prep_time' => 30,
            'cook_time' => 150,
            'servings' => 6,
            'difficulty' => 'medium',
            'cuisine' => 'Moroccan',
            'image_path' => 'recipe-images/lamb-tagine.jpg',
        ];
        
        $tagineIngredients = [
            ['name' => 'Lamb shoulder or neck, cut into 2-inch pieces (Lham)', 'quantity' => '1.5', 'unit' => 'kg'],
            ['name' => 'Onions, chopped (Basla)', 'quantity' => '2', 'unit' => 'large'],
            ['name' => 'Garlic cloves, minced (Touma)', 'quantity' => '4', 'unit' => ''],
            ['name' => 'Ginger, grated (Skinjbir)', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Ground cinnamon (Qarfa)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Ground ginger (Skinjbir)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Ground turmeric (Kharkoum)', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Ground cumin (Kamoun)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Paprika (Felfla Hamra)', 'quantity' => '1', 'unit' => 'tsp'],
            ['name' => 'Cayenne pepper (Felfla Hamra)', 'quantity' => '1/2', 'unit' => 'tsp'],
            ['name' => 'Salt (Melha)', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Black pepper (Ibzar)', 'quantity' => '', 'unit' => 'to taste'],
            ['name' => 'Prunes (Zbib)', 'quantity' => '1', 'unit' => 'cup'],
            ['name' => 'Honey (Assal)', 'quantity' => '2', 'unit' => 'tbsp'],
            ['name' => 'Olive oil (Zit Zitoune)', 'quantity' => '3', 'unit' => 'tbsp'],
            ['name' => 'Water (Ma)', 'quantity' => '2', 'unit' => 'cups'],
        ];
        
        $tagineSteps = [
            'Heat oil in a large tagine pot or Dutch oven over medium heat.',
            'Add the chopped onions and cook until they start to caramelize, stirring occasionally.',
            'Add the minced garlic and grated ginger, and cook for another minute.',
            'Add the lamb pieces and cook until browned on all sides, about 5 minutes.',
            'Add the cinnamon, ginger, turmeric, cumin, paprika, cayenne pepper, salt, and black pepper. Stir well to combine.',
            'Add the prunes, honey, and water. Bring to a boil, then reduce heat to low and simmer, covered, for about 2 1/2 hours, or until the lamb is tender.',
            'Serve the tagine hot, garnished with fresh parsley or cilantro, and accompanied by warm Moroccan bread (Khobz) or couscous.'
        ];
        
        $tagineEquipment = ['Tagine pot or Dutch oven', 'Large bowl for marinating', 'Sharp knife', 'Cutting board', 'Measuring spoons'];
        
        $this->createRecipe($tagineData, $chef, $mainCourse, $tagineIngredients, $tagineSteps, $tagineEquipment);
    }
}
