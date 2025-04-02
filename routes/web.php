<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

require __DIR__ . '/auth.php';