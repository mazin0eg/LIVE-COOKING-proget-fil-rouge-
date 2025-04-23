<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\AdminPage;
use App\Http\Controllers\ingrediantsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

// Debug route to check user role
Route::get('/debug-role', function () {
    if (Auth::check()) {
        return 'Logged in as: ' . Auth::user()->first_name . ', Role: ' . Auth::user()->role;
    } else {
        return 'Not logged in';
    }
});

// Test route to set user role to chef
Route::get('/set-chef-role', function () {
    if (Auth::check()) {
        $user = User::find(Auth::id());
        $user->role = 'chef';
        $user->save();
        return 'Role updated to chef for user: ' . $user->first_name;
    } else {
        return 'Not logged in';
    }
});

// Public routes
Route::get('/', [RecipeController::class, 'welcome'])->name('welcome');

Route::get('/about', function () {
    return view('about');
});

Route::get('/search', function () {
    return view('search');
});

// Recipe routes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recette/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/recipe/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipe.edit')->middleware('auth');
Route::put('/recipe/{recipe}', [RecipeController::class, 'update'])->name('recipe.update')->middleware('auth');
Route::delete('/recipe/{recipe}', [RecipeController::class, 'destroy'])->name('recipe.destroy')->middleware('auth');

Route::get('/cuisines', function () {
    return view('cuisines');
});

// Auth routes
Route::get('/login', [AuthController::class, 'ShowLogin'])->name('show.login');
Route::get('/register', [AuthController::class, 'ShowRegister'])->name('show.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contact routes
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

// Auth required routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('auth.profile');
    });
    
    // Chef only routes using Gate instead of middleware
    Route::get('/add', function () {
        if (Gate::allows('chef_redirection')) {
            return app(RecipeController::class)->create();
        }
        
        if (Auth::user()->role === 'cooker') {
            return redirect()->route('contact')->with('info', 'You need to be approved as a chef to add recipes. Please apply through the contact form.');
        }
        
        return redirect()->route('show.login')->with('error', 'You must be logged in as a chef to access this page.');
    })->name('recipe.create');
    
    Route::post('/add', function (\Illuminate\Http\Request $request) {
        if (Gate::allows('chef_redirection')) {
            return app(RecipeController::class)->store($request);
        }
        
        return redirect()->route('contact')->with('info', 'You need to be approved as a chef to add recipes.');
    })->name('recipe.store');
});

// Admin only routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (Gate::allows('admin_redirection')) {
            return app(AdminPage::class)->showadminpage();
        }
        return redirect('/')->with('error', 'You do not have permission to access the admin area.');
    })->name('admin.page');
    
    // Admin routes with Gate checks
    Route::post('/admin/categories', function (\Illuminate\Http\Request $request) {
        if (Gate::allows('admin_redirection')) {
            return app(CategoriesController::class)->addcategories($request);
        }
        return redirect('/');
    })->name('addcategories');
    
    Route::delete('/admin/categories/{id}', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(CategoriesController::class)->destroy($id);
        }
        return redirect('/');
    })->name('delete.category');
    
    Route::post('/admin/ingrediants', function (\Illuminate\Http\Request $request) {
        if (Gate::allows('admin_redirection')) {
            return app(IngrediantsController::class)->addingrediants($request);
        }
        return redirect('/');
    })->name('addingrediants');
    
    Route::delete('/admin/ingrediants/{id}', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(IngrediantsController::class)->destroy($id);
        }
        return redirect('/');
    })->name('delete.ingrediant');
    
    Route::post('/chef/approve/{id}', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(ContactController::class)->approveChef($id);
        }
        return redirect('/');
    })->name('chef.approve');
    
    Route::post('/chef/reject/{id}', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(ContactController::class)->rejectChef($id);
        }
        return redirect('/');
    })->name('chef.reject');
});
