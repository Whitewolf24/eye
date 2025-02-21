<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        if (Auth::check() || Cookie::get('oreo') === 'user_logged_in') {
            return redirect()->route('logged');
        }
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->route('login')
            ->with('status', 'error')
            ->with('message', 'Email already exists. Please log in.');
        }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $cookie = cookie()->make('oreo', 'user_logged_in', 43200, '/', null, true, true, false, 'Strict');

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('logged')
        ])->withCookie($cookie);
    }

    public function login(Request $request)
    {
        if (Auth::check() || Cookie::get('oreo') === 'user_logged_in') {
            return response()->json([
                'status' => 'success',
                'redirect_url' => route('logged')
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not found. Please register.'
            ], 404);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $cookie = cookie()->make('oreo', 'user_logged_in', 43200, '/', null, true, true, false, 'Strict');

            return response()->json([
                'status' => 'success',
                'redirect_url' => route('logged')
            ])->withCookie($cookie);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials. Please try again.'
        ], 401);
    }

    public function check_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['exists' => true]);
        }

        return response()->json(['exists' => false]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $cookie = Cookie::forget('oreo');
        return redirect('/')->with('success', 'You have successfully logged out.')->withCookie($cookie);
    }
}
