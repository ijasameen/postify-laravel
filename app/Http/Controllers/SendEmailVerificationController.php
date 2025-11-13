<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class SendEmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return to_route('home', status: 301);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
