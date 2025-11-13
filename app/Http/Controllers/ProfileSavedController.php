<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;

final class ProfileSavedController extends Controller
{
    public function __invoke(User $user)
    {
        $user->loadMissing(['saves' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        $savedPosts = $user->saves->where('savable_type', Post::getClassKey());
        $savedReplies = $user->saves->where('savable_type', Reply::getClassKey());

        $savedPosts->loadMissing(['savable' => function ($query) {
            $query
                ->withCount(['replies', 'likedUsers', 'savedUsers'])
                ->with([
                    'user',
                    'likedAuthenticatedUsers',
                    'savedAuthenticatedUsers',
                ]);
        }]);

        $savedReplies->loadMissing(['savable' => function ($query) {
            $query
                ->withCount(['likedUsers', 'savedUsers'])
                ->with([
                    'user',
                    'post',
                    'likedAuthenticatedUsers',
                    'savedAuthenticatedUsers',
                ]);
        }]);

        return view('users.profile-saved', ['profileOwner' => $user]);
    }
}
