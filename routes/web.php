<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware(['auth', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'profilePost'])->name('profile.update');
    Route::delete('/profile', [DashboardController::class, 'profileDelete'])->name('profile.destroy');

    Route::middleware(AdminMiddleware::class)->name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'home'])->name('home');

        Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'usersUpdate'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'usersDestroy'])->name('users.destroy');

        Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
        Route::get('/keywords', [AdminController::class, 'keywordsIndex'])->name('keywords.index');
        Route::get('/public-rooms', [AdminController::class, 'publicRoomsIndex'])->name('public_rooms.index');
        Route::get('/private-rooms', [AdminController::class, 'privateRoomsIndex'])->name('private_rooms.index');
    });
});
