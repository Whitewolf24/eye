<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
        // Validate input with stronger rules
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                function ($attribute, $value, $fail) {
                    // Check for Greek characters
                    if (preg_match('/[α-ωΑ-Ωά-ώΆ-Ώ]/', $value)) {
                        return $fail('Your password cannot contain Greek characters.');
                    }

                    // Check for other password requirements (at least one number, uppercase, lowercase, and symbol)
                    if (!preg_match('/[a-zA-Z]/', $value)) {
                        return $fail('Your password must contain at least one English letter.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        return $fail('Your password must contain at least one number.');
                    }
                    if (!preg_match('/[A-Z]/', $value)) {
                        return $fail('Your password must contain at least one uppercase letter.');
                    }
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
                return redirect()->route('logged');  // Redirect to the logged-in page
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

        // Redirect to the logged page after successful registration
        return redirect()->route('eye.logged');
    }


    // Login method
    public function login(Request $request)
    {
        // Validate the login inputs
        $credentials = $request->only('email', 'password');

        // Attempt login with provided credentials
        if (Auth::attempt([
            'email' => $credentials['email'], // Use 'email' here
            'password' => $credentials['password'],
        ])) {
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to the intended page (or default to dashboard)
            return redirect()->intended('/dashboard');
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

        // Redirect to the homepage with a success message
        return redirect('/')->with('success', 'You have successfully logged out.');
    }
}
