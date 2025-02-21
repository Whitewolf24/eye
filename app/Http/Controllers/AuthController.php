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
        // Check if the user is already logged in via session or cookie
        if (Auth::check() || Cookie::get('oreo') === 'user_logged_in') {
            return redirect()->route('logged');
        }

        // Validate the input fields for registration/login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Try to find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // User exists, attempt to log them in
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Regenerate session after login for security
                $request->session()->regenerate();

                // Create a cookie to track logged-in status
                $cookie = cookie()->make('oreo', 'user_logged_in', 43200, '/', null, true, true, false, 'Strict');

                // Redirect to the logged-in page
                return redirect()->route('logged')
                    ->with('status', 'success')
                    ->with('message', 'Successfully logged in.')
                    ->withCookie($cookie);
            } else {
                // If the password is incorrect, return error
                return redirect()->route('login')
                    ->with('status', 'error')
                    ->with('message', 'Invalid credentials. Please try again.');
            }
        } else {
            // User doesn't exist, register a new user
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log in the newly registered user
            Auth::login($user);

            // Create a cookie to track logged-in status
            $cookie = cookie()->make('oreo', 'user_logged_in', 43200, '/', null, true, true, false, 'Strict');

            // Redirect to the logged-in page with success message
            return redirect()->route('logged')
                ->with('status', 'success')
                ->with('message', 'Successfully registered and logged in.')
                ->withCookie($cookie);
        }
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
