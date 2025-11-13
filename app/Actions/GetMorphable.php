<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Database\Eloquent\Relations\Relation;

final class GetMorphable
{
    public function handle(string $likableTypeAlias, int $likableId): mixed
    {
        $likable_type = Relation::getMorphedModel($likableTypeAlias);
        $likable = $likable_type::find($likableId);

        return $likable;
    }
}
