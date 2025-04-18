<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\ingrediants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Show the form for creating a new recipe
     * Only accessible to users with the 'chef' role
     */
    public function create()
    {
        // Get categories and ingredients for the form
        $categories = categories::all();
        $ingrediants = ingrediants::all();
        
        return view('addrecette', compact('categories', 'ingrediants'));
    }
    
    /**
     * Store a newly created recipe
     */
    public function store(Request $request)
    {
        // Validation logic will go here
        
        // Recipe creation logic will go here
        
        return redirect()->route('profile')->with('success', 'Recipe created successfully!');
    }
}
