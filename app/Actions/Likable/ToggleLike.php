<?php

declare(strict_types=1);

namespace App\Actions\Likable;

use App\Models\User;

final readonly class ToggleLike
{
    public function __construct(private Like $like, private Unlike $unlike) {}

    public function handle(User $user, mixed $likable): bool
    {
        if (! $likable) {
            return false;
        }

        if ($likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unlike->handle($user, $likable);
        }

        return $this->like->handle($user, $likable);

    }
}
