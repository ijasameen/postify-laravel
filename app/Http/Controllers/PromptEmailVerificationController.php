<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class PromptEmailVerificationController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        /** @var User */
        $user = $request->user();

        return $user->hasVerifiedEmail()
            ? redirect()->intended(route('home', absolute: false))
            : view('auth.verify-email');
    }
}
