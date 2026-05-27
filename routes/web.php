<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/{product}', [HomeController::class, 'show'])
    ->name('products.show');

Route::get('/categories/{category}', [HomeController::class, 'category'])
    ->name('categories.show');

Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });

require __DIR__.'/auth.php';