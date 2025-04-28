<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
// Login method
public function login(Request $request)
{
    // Validate the login credentials
    $credentials = $request->only('email', 'password');

    // Attempt to log in the user
    if (Auth::attempt($credentials)) {
        $user = Auth::user();  // Get the authenticated user

        // Check if the user is an admin
        if ($user->hasRole('admin')) {
            dd($user->hasRole('admin'));  // Check if this returns true for the admin user
            // Redirect admin to the admin panel
            return redirect()->route('admin.users.index');
        }

        // Redirect other users to the default dashboard
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
}


}
