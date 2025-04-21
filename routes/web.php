<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/listing/{listing}/apply', [ApplicationController::class, 'create'])->name('listing.apply');
    Route::post('/listing/{listing}/apply', [ApplicationController::class, 'store'])->name('listing.apply.store');
});

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::resource('listing', ListingController::class)->except('index');

Route::middleware(['auth', 'verified', Admin::class])
    ->controller(AdminController::class)
    ->group(function(){
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/users/{user}', 'show')->name('user.show');
    Route::put('/admin/{user}/role', 'role')->name('admin.role');
    Route::put('/listing/{listing}/approve', 'approve')->name('admin.approve');
});


require __DIR__ . '/auth.php';