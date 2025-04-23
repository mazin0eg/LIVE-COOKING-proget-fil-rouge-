<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\ingrediants;
use App\Models\Contact;
use App\Models\Recipe;
use App\Models\User;
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
        
        return view('adminpage', compact('categories', 'ingrediants', 'chefApplications', 'recipes', 'recipeCount', 'chefCount'));
    }

   
        
}
