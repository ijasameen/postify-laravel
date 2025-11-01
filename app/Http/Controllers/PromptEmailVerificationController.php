<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromptEmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('home', absolute: false))
            : view('auth.verify-email');
    }
}
