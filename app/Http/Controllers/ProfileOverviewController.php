<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

final class ProfileOverviewController extends Controller
{
    public function __invoke(User $user): View
    {
        return view('users.profile-overview', ['profileOwner' => $user]);
    }
}
