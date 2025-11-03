<?php

namespace App\Actions\Likable;

use App\Models\User;

class ToggleLike
{
    public function __construct(protected Like $like, protected Unlike $unlike) {}

    public function handle(User $user, mixed $likable): bool
    {
        if (! $likable) {
            return false;
        }

        if ($likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unlike->handle($user, $likable);
        } else {
            return $this->like->handle($user, $likable);
        }
    }
}
