<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ProfileSavedController extends Controller
{
    public function __invoke(User $user): Factory|View
    {
        $user->loadMissing(['saves' => function ($query): void {
            $query->orderByDesc('created_at');
        }]);

        $savedPosts = $user->saves->where('savable_type', Post::getClassKey());
        $savedReplies = $user->saves->where('savable_type', Reply::getClassKey());

        $savedPosts->loadMissing(['savable' => function ($query): void {
            $query
                ->withCount(['replies', 'likedUsers', 'savedUsers'])
                ->with([
                    'user',
                    'likedAuthenticatedUsers',
                    'savedAuthenticatedUsers',
                ]);
        }]);

        $savedReplies->loadMissing(['savable' => function ($query): void {
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
