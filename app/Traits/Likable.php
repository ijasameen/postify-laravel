<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

trait Likable
{
    /** @return MorphToMany<User,$this> */
    public function likedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable', 'likes');
    }

    /** @return MorphToMany<User,$this> */
    public function likedAuthenticatedUsers(): MorphToMany
    {
        return $this->likedUsers()->where('id', Auth::id());
    }

    public function isAuthenticatedUserLiked(): bool
    {
        if ($this->relationLoaded('likedAuthenticatedUsers')) {
            return $this->likedAuthenticatedUsers->count() > 0;
        }

        return $this->likedAuthenticatedUsers()->count() > 0;
    }
}
