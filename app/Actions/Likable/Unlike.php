<?php

declare(strict_types=1);

namespace App\Actions\Likable;

use App\Models\User;

final class Unlike
{
    public function handle(User $user, mixed $likable): bool
    {
        if (! $likable) {
            return false;
        }

        if (! $likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return true;
        }

        $likable->likedUsers()->detach($user->id);

        return true;
    }
}
