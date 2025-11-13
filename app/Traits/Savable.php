<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Save;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

trait Savable
{
    /** @return MorphMany<Save,$this> */
    public function saves(): MorphMany
    {
        return $this->morphMany(Save::class, 'savable');
    }

    /** @return MorphToMany<User,$this> */
    public function savedUsers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'savable', 'saves');
    }

    /** @return MorphToMany<User,$this> */
    public function savedAuthenticatedUsers(): MorphToMany
    {
        return $this->savedUsers()->where('id', Auth::id());
    }

    public function isAuthenticatedUserSaved(): bool
    {
        if ($this->relationLoaded('savedAuthenticatedUsers')) {
            return $this->savedAuthenticatedUsers->count() > 0;
        }

        return $this->savedAuthenticatedUsers()->count() > 0;
    }
}
