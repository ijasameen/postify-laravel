<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasIdentity;
use App\Traits\Likable;
use App\Traits\Savable;
use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

final class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, HasIdentity, Likable, Savable, Sluggable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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
