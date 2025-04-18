<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\ingrediants;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminPage extends Controller
{
    public function showadminpage()
    {
        $categories = categories::all();  // Fetch all categories
      
        $ingrediants = ingrediants::all(); // Fetch all ingredients
        
      
        $chefApplications = Contact::where('is_chef_application', true)
                                  ->orderBy('created_at', 'desc')
                                  ->get();

        return view('adminpage', compact('categories', 'ingrediants', 'chefApplications'));
    }

   
        
}
