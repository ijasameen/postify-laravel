<?php

declare(strict_types=1);

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->chaperone();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->chaperone();
    }

    public function likedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likable', 'likes');
    }

    public function likedReplies(): MorphToMany
    {
        return $this->morphedByMany(Reply::class, 'likable', 'likes');
    }

    public function saves(): HasMany
    {
        return $this->hasMany(Save::class)->chaperone();
    }

    public function savedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'savable', 'saves');
    }

    public function savedReplies(): MorphToMany
    {
        return $this->morphedByMany(Reply::class, 'savable', 'saves');
    }

    /**
     * Return the sluggable configuration array for this model.
     */
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

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $attributes['first_name'].' '.$attributes['last_name'];
            },
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
