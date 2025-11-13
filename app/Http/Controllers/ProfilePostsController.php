<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

final class ProfilePostsController extends Controller
{
    public function __invoke(User $user)
    {
        $user->loadMissing(['posts' => function ($query) {
            $query->withCount(['replies', 'likedUsers', 'savedUsers'])
                ->orderByDesc('created_at')
                ->with([
                    'user',
                    'likedAuthenticatedUsers',
                    'savedAuthenticatedUsers',
                ]);
        }]);

        return view('users.profile-posts', ['profileOwner' => $user]);
    }
}
