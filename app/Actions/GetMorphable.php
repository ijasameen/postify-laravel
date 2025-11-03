<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Relations\Relation;

class GetMorphable
{
    public function handle(string $likableTypeAlias, int $likableId): mixed
    {
        $likable_type = Relation::getMorphedModel($likableTypeAlias);
        $likable = $likable_type::find($likableId);

        return $likable;
    }
}
