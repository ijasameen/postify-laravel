<?php

declare(strict_types=1);

namespace App\Actions\Likable;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;

final readonly class ToggleLike
{
    public function __construct(private Like $like, private Unlike $unlike) {}

    public function handle(?User $user, Post|Reply|null $likable): bool
    {
        if (! $likable || ! $user) {
            return false;
        }

        if ($likable->likedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unlike->handle($user, $likable);
        }

        return $this->like->handle($user, $likable);

    }
}
