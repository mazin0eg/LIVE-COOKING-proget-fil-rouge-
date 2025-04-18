<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\ingrediants;

class categoriesController extends Controller
{
   

    public function addcategories(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $categories = categories::create($validated);
        
        // Redirect back with success message instead of JSON response
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function destroy($id)
    {
        $categories = categories::findOrFail($id);
        $categories->delete();
        
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }


}
