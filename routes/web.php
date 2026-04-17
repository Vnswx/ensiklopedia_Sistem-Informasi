<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\adminController;

Route::get('/dashboard', function () {
    return view('main/homepage');
})->name('homepage');

Route::get('/login', [authController::class, 'showLogin'])->name('login');
Route::post('/login', [authController::class, 'login']);
Route::get('/register', [authController::class, 'showRegister']);
Route::post('/register', [authController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/panel', [adminController::class, 'index'])->name('admin.panel');
    Route::post('/logout', [authController::class, 'logout'])->name('logout');
    Route::get('/profile/edit', [authController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [authController::class, 'updateProfile'])->name('profile.update');
});