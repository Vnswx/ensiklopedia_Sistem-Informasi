<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\adminController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\articleController;

// Route::get('/dashboard', function () {
//     return view('main/homepage');
// })->name('homepage');

Route::get('/', [homepageController::class, 'index'])->name('homepage');

Route::get('/login', [authController::class, 'showLogin'])->name('login');
Route::post('/login', [authController::class, 'login']);
Route::get('/register', [authController::class, 'showRegister']);
Route::post('/register', [authController::class, 'register']);
Route::post('/logout', [authController::class, 'logout'])->name('logout');

Route::middleware(['auth',])->group(function () {
    Route::get('/profile/edit', [authController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [authController::class, 'updateProfile'])->name('profile.update');
    Route::get('/article', [articleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [articleController::class, 'create'])->name('article.create');
    Route::post('/article', [articleController::class, 'store'])->name('article.store');
    Route::get('/article/edit/{id}', [articleController::class, 'edit'])->name('article.edit');
    Route::post('/article/update/{id}', [articleController::class, 'update'])->name('article.update');
    Route::delete('/article/delete/{id}', [articleController::class, 'destroy'])->name('article.delete');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
    Route::get('/', [adminController::class, 'index'])->name('admin.panel');
    Route::get('/article', [adminController::class, 'articleApprove'])->name('admin.article');
    Route::post('/admin/article/{id}/approve', [adminController::class, 'approve'])->name('admin.approve');
    Route::post('/article/{id}/reject', [adminController::class, 'reject'])->name('admin.reject');
    Route::get('/pages', [pageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [pageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [pageController::class, 'store'])->name('pages.store');
    Route::get('/pages/edit/{id}', [pageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/update/{id}', [pageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/delete/{id}', [pageController::class, 'destroy'])->name('pages.delete');
});