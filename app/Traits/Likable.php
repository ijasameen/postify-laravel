<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Likable
{
    public function likedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable', 'likes');
    }

    public function isUserLiked(?User $user): bool
    {
        if (is_null($user)) {
            return false;
        }

        if ($this->relationLoaded('likedUsers')) {
            return $this->likedUsers->containsStrict('id', $user->id);
        }

        return $this->likedUsers()->where('id', $user->id)->exists();
    }
}
