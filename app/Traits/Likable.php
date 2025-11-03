<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

trait Likable
{
    public function likedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable', 'likes');
    }

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
