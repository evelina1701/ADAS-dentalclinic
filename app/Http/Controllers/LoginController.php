<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Applying the guest middleware for login route
        $this->middleware('guest')->except('logout');
    }

    // Add your login methods here
        // Login form method
        public function showLoginForm()
        {
            return view('auth.login');
        }
    
        // Login method
        public function login(Request $request)
        {
            // Your login logic here
        }
    
        // Logout method
        public function logout(Request $request)
        {
            Auth::logout();
            return redirect('/');
        }
}
