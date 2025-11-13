<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Stringable;

final class GetMorphable
{
    public function handle(string|Stringable $likableTypeAlias, int $likableId): mixed
    {
        $likable_type = Relation::getMorphedModel((string) $likableTypeAlias);

        return $likable_type::find($likableId);
    }
}
