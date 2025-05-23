<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\AdminPage;
use App\Http\Controllers\CookingController;
use App\Http\Controllers\ingrediantsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;





// Public routes
Route::get('/', [RecipeController::class, 'welcome'])->name('welcome');

Route::get('/about', function () {
    return view('about');
});

// Recipe search routes
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::post('/search', [RecipeController::class, 'search'])->name('recipes.search.post');
Route::get('/cuisine/{cuisine}', [RecipeController::class, 'byCuisine'])->name('recipes.by-cuisine');

// Route for saving cooking progress
Route::post('/recipes/save-progress', [RecipeController::class, 'saveProgress'])->middleware('auth')->name('recipes.save-progress');

// Recipe routes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/recipes/{recipe}/start-cooking', [RecipeController::class, 'startCooking'])->name('recipes.start-cooking');
Route::post('/recipes/save-progress', [RecipeController::class, 'saveProgress'])->name('recipes.save-progress');

// Chef routes (requires chef role)
Route::middleware(['auth'])->group(function () {
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
    
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipe.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipe.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipe.delete');
});

Route::get('/cuisines', function () {
    return view('cuisines');
})->name('cuisines');

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
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Cooking tracking routes
Route::middleware(['auth'])->prefix('cooking')->name('cooking.')->group(function () {
    Route::post('/start/{recipe}', [CookingController::class, 'startCooking'])->name('start');
    Route::put('/update/{cooking}', [CookingController::class, 'updateProgress'])->name('update');
    Route::put('/complete/{cooking}', [CookingController::class, 'completeCooking'])->name('complete');
});

// Admin only routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (Gate::allows('admin_redirection')) {
            return app(AdminPage::class)->showadminpage();
        }
        return redirect('/')->with('error', 'You do not have permission to access the admin area.');
    })->name('admin.dashboard');
    
    // Ban user route
    Route::post('/admin/users/{id}/ban', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(AdminPage::class)->banUser($id);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    })->name('admin.users.ban');
    
    // Delete user route
    Route::post('/admin/users/{id}', function ($id) {
        if (Gate::allows('admin_redirection')) {
            return app(AdminPage::class)->deleteUser($id);
        }
        return redirect()->back()->with('error', 'Unauthorized');
    })->name('admin.users.delete');
    
    // Category routes
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
