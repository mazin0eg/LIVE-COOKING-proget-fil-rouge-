<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\ingrediantsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/profile', function () {
    return view('auth.profile');
});


Route::get('/register2', function () {
    return view('auth.register_2');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/recette', function () {
    return view('recette');
});

Route::get('/add', function () {
    return view('addrecette');
});


// Categories Routes
Route::post('/admin/categories', [CategoriesController::class, 'addcategories'])->name('addcategories');
Route::get('/admin/categories', [CategoriesController::class, 'showadminpage'])->name('show.adminpage');
Route::delete('/admin/categories/{id}', [CategoriesController::class, 'destroy'])->name('delete.category');

// Ingrediants Routes
Route::post('/admin/ingrediants', [IngrediantsController::class, 'addingrediants'])->name('addingrediants');
Route::delete('/admin/ingrediants/{id}', [IngrediantsController::class, 'destroy'])->name('delete.ingrediant');




Route::get('/cuisines', function () {
    return view('cuisines');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login' ,[AuthController::class ,('ShowLogin')])->name('show.login');
Route::get('/register' ,[AuthController::class ,('ShowRegister')])->name('show.register');
Route::post('/login' ,[AuthController::class ,('login')])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
