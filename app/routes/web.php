<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriesController;
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


Route::post('/admin', [categoriesController::class, 'addcategories'])->name('addcategories'); 
Route::get('/admin', [categoriesController::class, 'showadminpage'])->name('show.adminpage'); 



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
