<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Middleware\CheckOreoCookie;


// Serve the 'eye.blade.php' view at the root ('/')
Route::get('/', function () {
    // Check if the 'oreo' cookie exists and has the value 'user_logged_in'
    if (Cookie::get('oreo') === 'user_logged_in') {
        // Redirect to the logged-in page
        return redirect()->route('logged');
    }

    // Otherwise, serve the eye view
    return view('eye.eye');
});

Route::post('/signup', [AuthController::class, 'register'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Logged-in page (protected)
Route::get('/logged', function () {
    $user = Auth::user();
    return view('eye.logged', ['email' => $user->email]);
})->middleware([CheckOreoCookie::class, 'auth'])->name('logged');
