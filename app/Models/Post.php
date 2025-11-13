<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasIdentity;
use App\Traits\Likable;
use App\Traits\Savable;
use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Date;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read string $slug
 * @property-read string $title
 * @property-read string $summary
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User $user
 * @property-read Collection<int,Reply>&SupportCollection<int,Reply> $replies
 */
final class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, HasIdentity, Likable, Savable, Sluggable;

    /** @return BelongsTo<User,$this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return HasMany<Reply,$this> */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)->chaperone();
    }

    public function getPostedTimeText(): string
    {
        $nowDate = Date::now();
        $postedDate = Date::parse($this->created_at);

        return $postedDate->diffForHumans($nowDate);
    }

    /** @return array<string,mixed> */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
                'maxLength' => 40,
                'onUpdate' => true,
                'maxLengthKeepWords' => true,
            ],
        ];
    }
}
