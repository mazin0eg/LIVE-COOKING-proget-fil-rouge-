<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ingrediants;

class ingrediantsController extends Controller
{
   

    public function addingrediants(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $ingrediants = ingrediants::create($validated);
        
        // Redirect back with success message instead of JSON response
        return redirect()->back()->with('success', 'ingrediant added successfully!');
    }

    public function destroy($id)
    {
        $ingrediants = ingrediants::findOrFail($id);
        $ingrediants->delete();
        
        return redirect()->back()->with('success', 'ingrediant deleted successfully!');
    }


}
