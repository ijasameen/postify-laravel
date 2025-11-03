<?php

namespace App\Actions\Likable;

use App\Models\User;

class Like
{
    public function handle(User $user, mixed $likable): bool
    {
        if (! $likable) {
            return false;
        }

        if ($likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return true;
        }

        $likable->likedUsers()->attach($user->id);

        return true;
    }
}
