<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [ProductController::class, 'getProductsByCategory'])->name('home');
Route::get('/{P_id}', [ProductController::class, 'show'])->name('PDetail');

// Profile
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

// Cart
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.add');
// Route::delete('/cart', [CartController::class, 'addToCart'])->name('cart.delete');