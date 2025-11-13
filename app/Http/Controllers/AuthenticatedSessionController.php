<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request, RateLimiter $limiter): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = Str::lower($request->string('email'));
        $password = $request->string('password');
        $remember = $request->boolean('remember');

        $throttleKey = Str::transliterate($email.'|'.$request->ip());
        if ($limiter->tooManyAttempts($throttleKey, 5)) {
            $waitTimeSeconds = $limiter->availableIn($throttleKey);
            $minutes = floor($waitTimeSeconds / 60);
            $seconds = $waitTimeSeconds - $minutes * 60;
            throw ValidationException::withMessages([
                'auth' => 'Too many login attempts. Please try again after '
                        .($minutes > 0 ? $minutes.' minutes and ' : '')
                        .$seconds.' seconds.',
            ]);
        }

        $isAttemptSuccess = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], $remember);

        if (! $isAttemptSuccess) {
            $limiter->hit($throttleKey, 120);

            throw ValidationException::withMessages([
                'auth' => 'The email and password does not match.',
            ]);
        }

        $request->session()->regenerate();
        $limiter->clear($throttleKey);

        return redirect()->intended(route('home'), 301);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return to_route('home', status: 301);
    }
}
