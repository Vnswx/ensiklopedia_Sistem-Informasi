<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\adminController;
use App\Http\Controllers\pageController;

Route::get('/dashboard', function () {
    return view('main/homepage');
})->name('homepage');

Route::get('/login', [authController::class, 'showLogin'])->name('login');
Route::post('/login', [authController::class, 'login']);
Route::get('/register', [authController::class, 'showRegister']);
Route::post('/register', [authController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Route::get('/admin', [adminController::class, 'index'])->name('admin.panel');
    // Route::get('/admin', [adminController::class, 'index'])->name('admin.panel');

    // Route::get('/pages', [pageController::class, 'index'])->name('pages.index');
    // Route::get('/pages/create', [pageController::class, 'create'])->name('pages.create');
    // Route::post('/pages', [pageController::class, 'store'])->name('pages.store');
    // Route::get('/pages/edit/{id}', [pageController::class, 'edit'])->name('pages.edit');
    // Route::post('/pages/update/{id}', [pageController::class, 'update'])->name('pages.update');
    // Route::delete('/pages/delete/{id}', [pageController::class, 'destroy'])->name('pages.delete');
    Route::post('/logout', [authController::class, 'logout'])->name('logout');
    Route::get('/profile/edit', [authController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [authController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/', [adminController::class, 'index'])->name('admin.panel');

    Route::get('/pages', [pageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [pageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [pageController::class, 'store'])->name('pages.store');
    Route::get('/pages/edit/{id}', [pageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/update/{id}', [pageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/delete/{id}', [pageController::class, 'destroy'])->name('pages.delete');
});