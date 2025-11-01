<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:2', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => Str::lower($request->input('email')),
            'password' => $request->input('password'),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        if ($request->hasSession()) {
            $request->session()->regenerate();
        }

        return to_route('home', status: 301);
    }
}
