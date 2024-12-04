<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Serve the 'eye.blade.php' view at the root ('/')
Route::get('/', function () {
    return view('eye.eye');
});

Route::post('/signup', [AuthController::class, 'register'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Logged-in page (protected)
Route::get('/logged', function () {
    return view('eye.logged');
})->middleware('auth')->name('logged');
