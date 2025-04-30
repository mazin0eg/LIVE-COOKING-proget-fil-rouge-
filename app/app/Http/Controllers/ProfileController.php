<?php

namespace App\Http\Controllers;

use App\Models\CookedRecipe;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        
        // Get recipes based on user role
        if ($user->role === 'chef') {
            // For chefs, get recipes they created
            $recipes = Recipe::where('user_id', $user->id)
                ->with(['categories', 'user'])
                ->latest()
                ->paginate(8);
                
            $recipesType = 'created';
        } else {
            // For regular users (cookers), get recipes they cooked
            $cookedRecipes = CookedRecipe::where('user_id', $user->id)
                ->where('completed_at', '!=', null)
                ->with('recipe.categories', 'recipe.user')
                ->latest()
                ->paginate(8);
                
            $recipes = $cookedRecipes;
            $recipesType = 'cooked';
        }
        
        return view('auth.profile', compact('user', 'recipes', 'recipesType'));
    }
    
    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }
    
    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|max:2048', // 2MB max
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        // Check current password if trying to change password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store new profile image
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            
            // Make sure the path is stored correctly
            $user->profile_image = $imagePath;
            
            // Log for debugging
            \Log::info('Profile image uploaded', [
                'user_id' => $user->id,
                'image_path' => $imagePath,
                'full_url' => asset('storage/' . $imagePath)
            ]);
        }
        
        // Update user details
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
        
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
