<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Savable
{
    public function savedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'savable', 'saves');
    }

    public function isUserSaved(?User $user): bool
    {
        if (is_null($user)) {
            return false;
        }

        if ($this->relationLoaded('savedUsers')) {
            return $this->savedUsers->containsStrict('id', $user->id);
        }

        return $this->savedUsers()->where('id', $user->id)->exists();
    }
}
