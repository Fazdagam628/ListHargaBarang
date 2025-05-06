<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::delete('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
Route::resource('products', ProductController::class);
Route::get('/', [ProductController::class, 'index'])->name('products.index');
