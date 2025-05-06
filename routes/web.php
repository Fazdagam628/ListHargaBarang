<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    Route::resource('products', ProductController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

require __DIR__ . '/auth.php';