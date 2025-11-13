<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ProfileRepliesController extends Controller
{
    public function __invoke(User $user): Factory|View
    {
        $user->loadMissing([
            'replies' => fn ($query) => $query
                ->orderByDesc('created_at')
                ->withCount(['likedUsers', 'savedUsers'])
                ->with(['user', 'post', 'likedAuthenticatedUsers', 'savedAuthenticatedUsers']),
        ]);

        return view('users.profile-replies', ['profileOwner' => $user]);
    }
}
