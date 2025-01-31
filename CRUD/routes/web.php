<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/product', [ProductController::class, 'index'])->name('product.index');
// Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
// Route::post('/product', [ProductController::class, 'store'])->name('product.store');
// Route::get('/product/{productid}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Route::put('/product/{productid}', [ProductController::class, 'update'])->name('product.update');
// Route::delete('/product/{productid}', [ProductController::class, 'destroy'])->name('product.destroy');

// Optimized the Route and make a group
Route::controller(ProductController::class)->group(function(){
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/create', 'create')->name('product.create');
    Route::post('/product', 'store')->name('product.store');
    Route::get('/product/{productid}/edit', 'edit')->name('product.edit');
    Route::put('/product/{productid}', 'update')->name('product.update');
    Route::delete('/product/{productid}', 'destroy')->name('product.destroy');
});