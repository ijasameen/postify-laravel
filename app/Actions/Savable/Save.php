<?php

namespace App\Actions\Savable;

use App\Models\User;

class Save
{
    public function handle(User $user, mixed $savable): bool
    {
        if (! $savable) {
            return false;
        }

        if ($savable->savedUsers()->where('user_id', $user->id)->exists()) {
            return true;
        }

        $savable->savedUsers()->attach($user->id);

        return true;
    }
}
