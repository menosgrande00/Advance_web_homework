<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;

Route::get('/', function () {
    return 'laravel project working';
});

Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.index');