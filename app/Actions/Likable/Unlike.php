<?php

declare(strict_types=1);

namespace App\Actions\Likable;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;

final class Unlike
{
    public function handle(?User $user, Post|Reply|null $likable): bool
    {
        if (! $likable || ! $user) {
            return false;
        }

        if (! $likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return true;
        }

        $likable->likedUsers()->detach($user->id);

        return true;
    }
}
