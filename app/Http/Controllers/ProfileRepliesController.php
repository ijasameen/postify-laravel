<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

final class ProfileRepliesController extends Controller
{
    public function __invoke(User $user)
    {
        $user->loadMissing([
            'replies' => function ($query) {
                return $query
                    ->orderByDesc('created_at')
                    ->withCount(['likedUsers', 'savedUsers'])
                    ->with(['user', 'post', 'likedAuthenticatedUsers', 'savedAuthenticatedUsers']);
            },
        ]);

        return view('users.profile-replies', ['profileOwner' => $user]);
    }
}
