<?php

declare(strict_types=1);

namespace App\Actions\Savable;

use App\Models\User;

final class ToggleSave
{
    public function __construct(private Save $save, private UnSave $unSave) {}

    public function handle(User $user, mixed $savable): bool
    {
        if (! $savable) {
            return false;
        }

        if ($savable->savedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unSave->handle($user, $savable);
        }

        return $this->save->handle($user, $savable);

    }
}
