<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileOverviewController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.profile-overview', ['profileOwner' => $user]);
    }
}
