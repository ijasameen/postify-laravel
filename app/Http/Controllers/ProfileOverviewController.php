<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

final class ProfileOverviewController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.profile-overview', ['profileOwner' => $user]);
    }
}
