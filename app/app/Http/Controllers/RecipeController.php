<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\RecipeEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes
     */
    public function index()
    {
        $recipes = Recipe::with(['user', 'categories', 'ingredients'])->latest()->paginate(12);
        return view('search', compact('recipes'));
    }
    
    /**
     * Display recipes on the welcome page
     */
    public function welcome()
    {
        // Get latest recipes with their chefs (users)
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();
        
        // Get popular recipes (could be based on views or ratings in the future)
        $popularRecipes = Recipe::with('user')->inRandomOrder()->take(4)->get();
        
        // Get new recipes from the last 7 days
        $newRecipes = Recipe::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(4)
            ->get();
            
        return view('welcome', compact('latestRecipes', 'popularRecipes', 'newRecipes'));
    }
    
    /**
     * Display the specified recipe
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['user', 'categories', 'ingredients', 'steps', 'equipment']);
        return view('recette', compact('recipe'));
    }
    
    /**
     * Show the form for creating a new recipe
     * Only accessible to users with the 'chef' role
     */
    public function create()
    {
        // Get categories for the form
        $categories = categories::all();
        
        return view('addrecette', compact('categories'));
    }
    
    /**
     * Store a newly created recipe
     */
    public function store(Request $request)
    {
        // Log the request data for debugging
        Log::info('Recipe submission received', ['request' => $request->except(['image', 'step_images'])]);
        Log::info('Files in request', [
            'has_image' => $request->hasFile('image'),
            'step_images_count' => $request->hasFile('step_images') ? count($request->file('step_images')) : 0
        ]);
        
        try {
            // Validate the request data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'prep_time' => 'required|integer|min:1',
                'cook_time' => 'required|integer|min:1',
                'servings' => 'required|integer|min:1',
                'category_id' => 'required|exists:categories,id',
                'difficulty' => 'required|string|in:easy,medium,hard',
                'cuisine' => 'required|string',
                'image' => 'required|image|max:5120', // 5MB max
                'ingredients' => 'required|array|min:1',
                'ingredients.*' => 'required|string',
                'quantities' => 'required|array|min:1',
                'quantities.*' => 'required|string',
                'units' => 'required|array|min:1',
                'units.*' => 'required|string',
                'steps' => 'required|array|min:1',
                'steps.*' => 'required|string',
                'equipment' => 'required|array|min:1',
                'equipment.*' => 'required|string',
            ]);
            
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('recipe-images', 'public');
                Log::info('Image uploaded successfully', ['path' => $imagePath]);
            } else {
                Log::error('No image file found in request');
                return back()->withInput()->withErrors(['image' => 'Please upload a main recipe image']);
            }
            
            // Create the recipe
            $recipe = Recipe::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'user_id' => Auth::id(),
                'prep_time' => $validated['prep_time'],
                'cook_time' => $validated['cook_time'],
                'servings' => $validated['servings'],
                'difficulty' => $validated['difficulty'],
                'cuisine' => $validated['cuisine'],
                'image_path' => $imagePath,
            ]);
            
            Log::info('Recipe created successfully', ['recipe_id' => $recipe->id]);
            
            // Attach category
            // Use the correct column names for the pivot table
            $recipe->categories()->attach($validated['category_id']);
            
            // Log the category attachment for debugging
            Log::info('Category attached to recipe', [
                'recipe_id' => $recipe->id,
                'category_id' => $validated['category_id']
            ]);
            
            // Add ingredients
            if (isset($validated['ingredients']) && is_array($validated['ingredients'])) {
                for ($i = 0; $i < count($validated['ingredients']); $i++) {
                    if (!empty($validated['ingredients'][$i])) {
                        RecipeIngredient::create([
                            'recipe_id' => $recipe->id,
                            'name' => $validated['ingredients'][$i],
                            'quantity' => $validated['quantities'][$i] ?? '',
                            'unit' => $request->units[$i] ?? '',
                        ]);
                    }
                }
            }
            
            // Add steps
            if (isset($validated['steps']) && is_array($validated['steps'])) {
                for ($i = 0; $i < count($validated['steps']); $i++) {
                    if (!empty($validated['steps'][$i])) {
                        // Handle step image if present
                        $stepImagePath = null;
                        if ($request->hasFile('step_images') && isset($request->file('step_images')[$i])) {
                            $stepImagePath = $request->file('step_images')[$i]->store('recipe-step-images', 'public');
                        }
                        
                        // Create step
                        RecipeStep::create([
                            'recipe_id' => $recipe->id,
                            'description' => $validated['steps'][$i],
                            'order' => $i + 1,
                            'image_path' => $stepImagePath,
                        ]);
                    }
                }
            }
            
            // Add equipment
            if (isset($validated['equipment']) && is_array($validated['equipment'])) {
                foreach ($validated['equipment'] as $equipmentName) {
                    if (!empty($equipmentName)) {
                        RecipeEquipment::create([
                            'recipe_id' => $recipe->id,
                            'name' => $equipmentName,
                        ]);
                    }
                }
            }
            
            return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating recipe', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['general' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Show the form for editing the specified recipe
     * Only accessible to the recipe owner or admins
     */
    public function edit(Recipe $recipe)
    {
        // Check if user is authorized to edit this recipe
        if (Auth::id() !== $recipe->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('recipes.show', $recipe)->with('error', 'You are not authorized to edit this recipe.');
        }
        
        // Load the recipe with its relationships
        $recipe->load(['categories', 'ingredients', 'steps', 'equipment']);
        
        // Get categories for the form
        $categories = categories::all();
        
        return view('editrecipe', compact('recipe', 'categories'));
    }
    
    /**
     * Update the specified recipe
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Check if user is authorized to update this recipe
        if (Auth::id() !== $recipe->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('recipes.show', $recipe)->with('error', 'You are not authorized to update this recipe.');
        }
        
        try {
            // Validate the request data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'prep_time' => 'required|integer|min:1',
                'cook_time' => 'required|integer|min:1',
                'servings' => 'required|integer|min:1',
                'category_id' => 'required|exists:categories,id',
                'difficulty' => 'required|string|in:easy,medium,hard',
                'cuisine' => 'required|string',
                'image' => 'nullable|image|max:5120', // 5MB max
                'ingredients' => 'required|array|min:1',
                'ingredients.*' => 'required|string',
                'quantities' => 'required|array|min:1',
                'quantities.*' => 'required|string',
                'units' => 'required|array|min:1',
                'units.*' => 'required|string',
                'steps' => 'required|array|min:1',
                'steps.*' => 'required|string',
                'equipment' => 'required|array|min:1',
                'equipment.*' => 'required|string',
            ]);
            
            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($recipe->image_path) {
                    Storage::disk('public')->delete($recipe->image_path);
                }
                
                $imagePath = $request->file('image')->store('recipe-images', 'public');
                $recipe->image_path = $imagePath;
            }
            
            // Update the recipe
            $recipe->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'prep_time' => $validated['prep_time'],
                'cook_time' => $validated['cook_time'],
                'servings' => $validated['servings'],
                'difficulty' => $validated['difficulty'],
                'cuisine' => $validated['cuisine'],
            ]);
            
            // Update category
            $recipe->categories()->sync([$validated['category_id']]);
            
            // Update ingredients - delete existing and add new ones
            $recipe->ingredients()->delete();
            if (isset($validated['ingredients']) && is_array($validated['ingredients'])) {
                for ($i = 0; $i < count($validated['ingredients']); $i++) {
                    if (!empty($validated['ingredients'][$i])) {
                        RecipeIngredient::create([
                            'recipe_id' => $recipe->id,
                            'name' => $validated['ingredients'][$i],
                            'quantity' => $validated['quantities'][$i] ?? '',
                            'unit' => $request->units[$i] ?? '',
                        ]);
                    }
                }
            }
            
            // Update steps - delete existing and add new ones
            // First, delete old step images
            foreach ($recipe->steps as $step) {
                if ($step->image_path) {
                    Storage::disk('public')->delete($step->image_path);
                }
            }
            $recipe->steps()->delete();
            
            if (isset($validated['steps']) && is_array($validated['steps'])) {
                for ($i = 0; $i < count($validated['steps']); $i++) {
                    if (!empty($validated['steps'][$i])) {
                        // Handle step image if present
                        $stepImagePath = null;
                        if ($request->hasFile('step_images') && isset($request->file('step_images')[$i])) {
                            $stepImagePath = $request->file('step_images')[$i]->store('recipe-step-images', 'public');
                        }
                        
                        // Create step
                        RecipeStep::create([
                            'recipe_id' => $recipe->id,
                            'description' => $validated['steps'][$i],
                            'order' => $i + 1,
                            'image_path' => $stepImagePath,
                        ]);
                    }
                }
            }
            
            // Update equipment - delete existing and add new ones
            $recipe->equipment()->delete();
            if (isset($validated['equipment']) && is_array($validated['equipment'])) {
                foreach ($validated['equipment'] as $equipmentName) {
                    if (!empty($equipmentName)) {
                        RecipeEquipment::create([
                            'recipe_id' => $recipe->id,
                            'name' => $equipmentName,
                        ]);
                    }
                }
            }
            
            return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating recipe', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['general' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Remove the specified recipe from storage
     * Only accessible to the recipe owner or admins
     */
    public function destroy(Recipe $recipe)
    {
        // Check if user is authorized to delete this recipe
        if (Auth::id() !== $recipe->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('recipes.show', $recipe)->with('error', 'You are not authorized to delete this recipe.');
        }
        
        try {
            // Delete recipe image
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            
            // Delete step images
            foreach ($recipe->steps as $step) {
                if ($step->image_path) {
                    Storage::disk('public')->delete($step->image_path);
                }
            }
            
            // Delete recipe and all related records (ingredients, steps, equipment)
            // This will cascade delete if you've set up your foreign keys correctly
            $recipe->delete();
            
            // If request is from admin page, redirect to admin page
            if (request()->is('admin*')) {
                return redirect()->route('admin.page')->with('success', 'Recipe deleted successfully!');
            }
            
            // Otherwise redirect to recipes index
            return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting recipe', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // If request is from admin page, redirect to admin page
            if (request()->is('admin*')) {
                return redirect()->route('admin.page')->with('error', 'Failed to delete recipe: ' . $e->getMessage());
            }
            
            return redirect()->route('recipes.show', $recipe)->with('error', 'Failed to delete recipe: ' . $e->getMessage());
        }
    }
}
