<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class PromptEmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('home', absolute: false))
            : view('auth.verify-email');
    }
}
