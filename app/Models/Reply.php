<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasIdentity;
use App\Traits\Likable;
use App\Traits\Savable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Reply extends Model
{
    /** @use HasFactory<\Database\Factories\ReplyFactory> */
    use HasFactory, HasIdentity, Likable, Savable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
