<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class categoriesController extends Controller
{

    public function showadminpage()
    {
        return view('adminpage');
    }
    public function addcategories(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:200',
            'recipes_id' => 'required|string|max:200',
        ]);

        $category = Categories::create($validated);
        return response()->json($category, 201);
    }
}
