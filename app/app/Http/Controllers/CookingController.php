<?php

namespace App\Http\Controllers;

use App\Models\CookedRecipe;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CookingController extends Controller
{
    /**
     * Start cooking a recipe
     */
    public function startCooking(Recipe $recipe)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to track your cooking progress'
            ]);
        }
        
        // Count total steps in the recipe
        $totalSteps = $recipe->steps()->count();
        
        // Create or update cooking record
        $cookingRecord = CookedRecipe::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'recipe_id' => $recipe->id,
                'completed_at' => null, // Only get active (incomplete) cooking sessions
            ],
            [
                'total_steps' => $totalSteps,
                'completed_steps' => 0,
                'cooking_time' => 0,
            ]
        );
        
        return response()->json([
            'success' => true,
            'cooking_id' => $cookingRecord->id,
            'total_steps' => $totalSteps,
            'message' => 'Started cooking ' . $recipe->title
        ]);
    }
    
    /**
     * Update cooking progress
     */
    public function updateProgress(Request $request, CookedRecipe $cooking)
    {
        // Validate the request
        $validated = $request->validate([
            'completed_steps' => 'required|integer|min:0',
            'cooking_time' => 'required|integer|min:0',
        ]);
        
        // Check if this cooking record belongs to the authenticated user
        if ($cooking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Update the cooking record
        $cooking->update([
            'completed_steps' => $validated['completed_steps'],
            'cooking_time' => $validated['cooking_time'],
        ]);
        
        return response()->json([
            'success' => true,
            'completed_steps' => $cooking->completed_steps,
            'total_steps' => $cooking->total_steps,
            'cooking_time' => $cooking->cooking_time,
            'message' => 'Progress updated'
        ]);
    }
    
    /**
     * Complete cooking a recipe
     */
    public function completeCooking(CookedRecipe $cooking)
    {
        // Check if this cooking record belongs to the authenticated user
        if ($cooking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        
        // Mark the cooking as completed
        $cooking->update([
            'completed_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Congratulations! You have completed cooking ' . $cooking->recipe->title,
            'cooking_time' => $cooking->cooking_time,
            'completed_steps' => $cooking->completed_steps,
        ]);
    }
}
