<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $user_id
 * @property-read int $savable_id
 * @property-read string $savable_type
 * @property-read Carbon $created_at
 * @property-read User $user
 */
final class Save extends Model
{
    use HasFactory;

    /** @return MorphTo<Model,$this> */
    public function savable(): MorphTo
    {
        return $this->morphTo();
    }

    /** @return BelongsTo<User,$this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
