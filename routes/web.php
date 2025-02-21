<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\CSPReportController;


// Serve the 'eye.blade.php' as root 
Route::get('/', function () {
    // if 'oreo' exists and has 'user_logged_in' redirect to the logged-in page
    if (Cookie::get('oreo') === 'user_logged_in') {
        return redirect()->route('logged');
    }
    return view('eye.eye');
});

Route::post('/signup', [AuthController::class, 'register'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/check-user', [AuthController::class, 'check_user']);
Route::post('/csp-violation-report-endpoint', [CSPReportController::class, 'handleReport']);

Route::get('/login', function () {
    $user = Auth::user();
    if (!$user) {
        return redirect('/')->withErrors(['auth' => 'You are not logged in.']);
    }
})->name('login');

Route::get('/logged', function () {
    if (!Cookie::get('oreo')) {
        return redirect('/')->withErrors(['cookie' => 'You are not logged in.']);
    }

    $user = Auth::user();
    if (!$user) {
        return redirect('/')->withErrors(['auth' => 'You are not logged in.']);
    }
    return view('eye.logged', ['email' => $user->email]);
})->name('logged');
