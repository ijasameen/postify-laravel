<?php

namespace App\Actions\Savable;

use App\Models\User;

class ToggleSave
{
    public function __construct(protected Save $save, protected UnSave $unSave) {}

    public function handle(User $user, mixed $savable): bool
    {
        if (! $savable) {
            return false;
        }

        if ($savable->savedUsers()->where('user_id', $user->id)->exists()) {
            return $this->unSave->handle($user, $savable);
        } else {
            return $this->save->handle($user, $savable);
        }
    }
}
