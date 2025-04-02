<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;

class categoriesController extends Controller
{
    public function showadminpage()
    {
        // Fetch categories to display in the admin page
        $categories = categories::all();
        return view('adminpage', ['categories' => $categories]);
    }

    public function addcategories(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $category = Categories::create($validated);
        
        // Redirect back with success message instead of JSON response
        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
