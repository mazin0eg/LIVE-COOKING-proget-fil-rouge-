<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use App\Models\categories;
use App\Models\ingrediants;
use App\Models\RecipeEquipment;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\CookedRecipe;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminPage extends Controller
{
    public function showadminpage()
    {
        // Fetch all categories
        $categories = categories::all();
      
        // Fetch all ingredients
        $ingrediants = ingrediants::all();
        
        // Fetch chef applications
        $chefApplications = Contact::where('is_chef_application', true)
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        
        // Fetch recipes with their related user (chef)
        $recipes = Recipe::with('user')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        // Get recipe statistics
        $recipeCount = Recipe::count();
        $chefCount = User::where('role', 'chef')->count();
        
        // Fetch all users for the user management modal
        $users = User::orderBy('created_at', 'desc')->get();
        
        return view('adminpage', compact('categories', 'ingrediants', 'chefApplications', 'recipes', 'recipeCount', 'chefCount', 'users'));
    }

    /**
     * Ban a user
     */
    public function banUser($id)
    {
        $user = User::findOrFail($id);
        
        // Here you would implement your ban logic
        // For example, you could set a 'banned' flag to true
        // Or you could delete the user account
        
        // For now, we'll just change their role to 'banned'
        $user->update([
            'role' => 'banned'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'User has been banned successfully'
        ]);
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Delete the user's recipes if they are a chef
            if ($user->role === 'chef') {
                // Get all recipes by this user
                $recipes = Recipe::where('user_id', $user->id)->get();
                
                foreach ($recipes as $recipe) {
                    // Delete recipe ingredients, steps, and equipment
                    RecipeIngredient::where('recipe_id', $recipe->id)->delete();
                    RecipeStep::where('recipe_id', $recipe->id)->delete();
                    RecipeEquipment::where('recipe_id', $recipe->id)->delete();
                    
                    // Delete the recipe itself
                    $recipe->delete();
                }
            }
            
            // Delete the user's cooked recipes
            CookedRecipe::where('user_id', $user->id)->delete();
            
            // Delete the user
            $user->delete();
            
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
