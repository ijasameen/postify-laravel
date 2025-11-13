<?php

declare(strict_types=1);

namespace App\Actions\Savable;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;

final readonly class ToggleSave
{
    public function __construct(private Save $save, private UnSave $unSave) {}

    public function handle(?User $user, Post|Reply|null $savable): bool
    {
        if (! $user || ! $savable) {
            return false;
        }

        if ($savable->savedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unSave->handle($user, $savable);
        }

        return $this->save->handle($user, $savable);

    }
}
