<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest'])->except(['destroy']);
        $this->middleware(['auth'])->only(['destroy']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Data validation
        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // log the user in
        if (!auth()->attempt($credentials, $request->remember)) {
            return back()->withErrors(['msg' => 'Wrong email or password']);
        }

        $request->session()->regenerate();

        // redirect
        return redirect()->route('dashboard');
    }

    public function destroy(Request $request)
    {
        if (empty($request->_token)) return back();

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
