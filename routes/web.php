<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('home'); 
})->name('home');

// About route
Route::get('/profile', function () {
    return view('pages.profile'); 
})->name('profile');

// Services route
Route::get('/favorites', function () {
    return view('pages.fav'); 
})->name('favorites');

// Contact route
Route::get('/cart', function () {
    return view('pages.cart'); 
})->name('cart');

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/', [ProductController::class, 'getProductsByCategory'])->name('home');
