<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
        // Validate input with stronger rules
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8', // Make sure password is at least 8 characters
                function ($attribute, $value, $fail) {
                    // Check for Greek characters
                    if (preg_match('/[α-ωΑ-Ωά-ώΆ-Ώ]/', $value)) {
                        return $fail('Your password cannot contain Greek characters.');
                    }

                    // Check for at least one letter (either uppercase or lowercase)
                    if (!preg_match('/[a-zA-Z]/', $value)) {
                        return $fail('Your password must contain at least one English letter.');
                    }

                    // Check for at least one number
                    if (!preg_match('/[0-9]/', $value)) {
                        return $fail('Your password must contain at least one number.');
                    }

                    // Check for at least one uppercase letter
                    if (!preg_match('/[A-Z]/', $value)) {
                        return $fail('Your password must contain at least one uppercase letter.');
                    }

                    // Check for at least one symbol
                    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                        return $fail('Your password must contain at least one symbol.');
                    }
                },
            ],
        ]);

        // Check if the email already exists in the database
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // If the user exists, log them in instead of creating a new user
            if (Hash::check($request->password, $existingUser->password)) {
                Auth::login($existingUser);

                // Create a cookie 'oreo' for the user (expires in 1 month)
                $cookie = cookie('oreo', 'user_logged_in', 43200); // 43200 minutes = 1 month

                return redirect()->route('logged')->withCookie($cookie);  // Redirect to the logged-in page
            } else {
                // If the password does not match, return an error
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ]);
            }
        }

        // If no user exists, create a new user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Create a cookie 'oreo' for the newly registered user (expires in 1 month)
        $cookie = cookie('oreo', 'user_logged_in', 43200);

        return redirect()->route('logged')->withCookie($cookie);
    }



    // Login method
    public function login(Request $request)
    {
        // Validate the login inputs
        $credentials = $request->only('email', 'password');

        // Attempt login with provided credentials
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            // Create a cookie 'oreo' for the logged-in user that expires in one month
            $cookie = cookie('oreo', 'user_logged_in', 43200);

            // Redirect to the intended page (or default to /logged)
            return redirect()->intended('/logged')->withCookie($cookie);
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }


    // Logout method
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Delete the 'oreo' cookie
        $cookie = Cookie::forget('oreo'); // This deletes the 'oreo' cookie

        // Redirect to the homepage with a success message and the cookie removal
        return redirect('/')->with('success', 'You have successfully logged out.')->withCookie($cookie);
    }
}
