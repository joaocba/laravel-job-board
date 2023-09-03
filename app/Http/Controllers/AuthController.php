<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        // guest users can only access the defined except methods
        $this->middleware('guest')->except([
            'destroy'
        ]);
    }

    /**
     * Display a registration form.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //$credentials = $request->only('email', 'password');
        //Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('login')
            ->with(
                'success', 'You have successfully registered! You can now login.'
            );
    }

    /**
     * Display a login form.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(Request $request)
    {
        // validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // filter out the request for the credentials (do not show them in the url)
        $credentials = $request->only('email', 'password');

        // this will check if the remember me checkbox is checked
        $remember = $request->filled('remember');

        // perform the login, it will return true or false and save the session
        if(auth()->attempt($credentials, $remember)) {
            // intended() will redirect the user to the page they were trying to access before they were redirected to the login page
            return redirect()->intended('/');
        } else {
            // if the user is not logged in, redirect back to the login page with an error message
            return redirect()->back()
                ->with('error', 'Invalid credentials');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // logout the user
        Auth::logout();

        // invalidate the session, clear the session data
        request()->session()->invalidate();

        // regenerate the CSRF token, make sure the user is not vulnerable to CSRF attacks
        request()->session()->regenerateToken();

        // redirect the user to the login page
        return redirect('/jobs')
            ->with(
                'success', 'You have successfully logged out!'
            );
    }
}
