<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Data validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|min:8|max:255|alpha_num',
            'email' => 'required|email',
            'password' => 'required|regex:#^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])[a-zA-Z\d]{8,}$#|confirmed',
        ]);

        // Store user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // log the user in
        auth()->login($user);

        // redirect
        return redirect()->route('dashboard');
    }
}
