<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

final class RegisteredUserController extends Controller
{
    public function create(): Factory|View
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

        $user = User::query()->create([
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
