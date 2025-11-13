<?php

declare(strict_types=1);

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

/**
 * @property-read int $id
 * @property-read string $username
 * @property-read string $first_name
 * @property-read string $last_name
 * @property-read string $profile_image
 * @property-read string $email
 * @property-read Carbon $email_verfied_at
 * @property-read string $password
 * @property-read string $remember_token
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Collection<int,Post>$SupportCollection<int,Post> $posts
 * @property-read Collection<int,Reply>&SupportCollection<int,Reply> $replies
 * @property-read Collection<int,Save>&SupportCollection<int,Save> $saves
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return HasMany<Post,$this> */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->chaperone();
    }

    /** @return HasMany<Reply,$this> */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->chaperone();
    }

    /** @return MorphToMany<Post,$this> */
    public function likedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likable', 'likes');
    }

    /** @return MorphToMany<Reply,$this> */
    public function likedReplies(): MorphToMany
    {
        return $this->morphedByMany(Reply::class, 'likable', 'likes');
    }

    /** @return HasMany<Save,$this> */
    public function saves(): HasMany
    {
        return $this->hasMany(Save::class)->chaperone();
    }

    /** @return MorphToMany<Post,$this> */
    public function savedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'savable', 'saves');
    }

    /** @return MorphToMany<Reply,$this> */
    public function savedReplies(): MorphToMany
    {
        return $this->morphedByMany(Reply::class, 'savable', 'saves');
    }

    /** @return array<string,mixed> */
    public function sluggable(): array
    {
        return [
            'username' => [
                'source' => ['first_name', 'last_name'],
                'maxLength' => 40,
                'onUpdate' => false,
            ],
        ];
    }

    /** @return Attribute<callable,callable> */
    protected function fullName(): Attribute
    {
        /**
         * @param  mixed  $value
         * @param  array<string>  $attributes
         */
        $callback = fn (mixed $value, array $attributes): string => $attributes['first_name'].' '.$attributes['last_name'];

        return Attribute::make(
            get: $callback,
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
