<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileSavedController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.profile-saved', ['profileOwner' => $user]);
    }
}
