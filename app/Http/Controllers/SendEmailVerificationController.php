<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailVerificationController extends Controller
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
