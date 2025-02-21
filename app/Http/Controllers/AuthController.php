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
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (preg_match('/[α-ωΑ-Ωά-ώΆ-Ώ]/', $value)) {
                        return $fail('Your password cannot contain Greek characters.');
                    }
                    if (!preg_match('/[a-zA-Z]/', $value)) {
                        return $fail('Your password must contain at least one English letter.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        return $fail('Your password must contain at least one number.');
                    }
                    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                        return $fail('Your password must contain at least one symbol.');
                    }
                },
            ],
        ]);

        $exists = User::where('email', $request->email)->first();
        if ($exists) {
            return redirect()->route('login')
                ->with('status', 'error')
                ->with('message', 'This email is already registered. Please log in.');
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $cookie = cookie()->make('oreo', 'user_logged_in', 43200, '/', null, true, true, false, 'Strict');

        return redirect()->route('logged')
            ->with('status', 'success')
            ->with('message', 'Successfully registered and logged in.')
            ->withCookie($cookie);
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
