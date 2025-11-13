<?php

declare(strict_types=1);

namespace App\Actions\Savable;

use App\Models\User;

final class UnSave
{
    public function handle(User $user, mixed $savable): bool
    {
        if (! $savable) {
            return false;
        }

        if (! $savable->savedUsers()->where('user_id', $user->id)->exists()) {
            return true;
        }

        $savable->savedUsers()->detach($user->id);

        return true;
    }
}
