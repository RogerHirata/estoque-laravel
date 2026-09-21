<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('orders', OrderController::class);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
