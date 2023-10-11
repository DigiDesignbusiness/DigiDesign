<?php

use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/',[HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('product-detail/{id}',[HomeController::class, 'productDetail'])->name('product-detail');
Route::post('/add-cart/{id}', [HomeController::class, 'addToCart'])->name('add-cart');
Route::get('/show-cart', [HomeController::class, 'showCart'])->name('show-cart');
Route::delete('/remove-cart-item/{id}', [HomeController::class, 'removeCartItem'])->name('remove-cart-item');

Route::get('/cash-order', [HomeController::class, 'cashOrder'])->name('cash-order');

require __DIR__.'/../auth.php';
