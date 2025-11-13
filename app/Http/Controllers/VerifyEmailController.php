<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

final class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return to_route('home', status: 301);
    }
}
