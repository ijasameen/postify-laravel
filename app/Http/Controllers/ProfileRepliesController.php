<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileRepliesController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.profile-replies', ['profileOwner' => $user]);
    }
}
