<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Stringable;

final class GetMorphable
{
    public function handle(string|Stringable $likableTypeAlias, int $likableId): Post|Reply|null
    {
        /** @var class-string */
        $likable_type = Relation::getMorphedModel((string) $likableTypeAlias);

        /** @var Post|Reply|null */
        $likable = $likable_type::find($likableId);

        return $likable;
    }
}
