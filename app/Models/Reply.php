<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasIdentity;
use App\Traits\Likable;
use App\Traits\Savable;
use Database\Factories\ReplyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read int $post_id
 * @property-read string $body
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User $user
 * @property-read Post $post
 */
final class Reply extends Model
{
    /** @use HasFactory<ReplyFactory> */
    use HasFactory, HasIdentity, Likable, Savable;

    /** @return BelongsTo<User,$this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Post,$this> */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
