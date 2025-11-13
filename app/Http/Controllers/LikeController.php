<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetMorphable;
use App\Actions\Likable\Like;
use App\Actions\Likable\ToggleLike;
use App\Actions\Likable\Unlike;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final class LikeController extends Controller
{
    public function __construct(
        private readonly GetMorphable $getMorphable,
    ) {}

    public function store(Request $request, Like $like): RedirectResponse
    {
        $request->validate([
            'likable_id' => ['required', 'integer'],
            'likable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $likableTypeAlias = $request->string('likable_type_alias');
        $likableId = $request->integer('likable_id');

        $isLiked = $like->handle(
            $request->user(),
            $this->getMorphable->handle($likableTypeAlias, $likableId)
        );

        if ($isLiked) {
            $to = back()->getTargetUrl().'#'.$likableTypeAlias.'-'.$likableId;

            return redirect($to);
        }

        return back(301);
    }

    public function update(Request $request, ToggleLike $toggleLike): RedirectResponse
    {
        $request->validate([
            'likable_id' => ['required', 'integer'],
            'likable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $likableTypeAlias = $request->string('likable_type_alias');
        $likableId = $request->integer('likable_id');

        $isUpdated = $toggleLike->handle(
            $request->user(),
            $this->getMorphable->handle($likableTypeAlias, $likableId)
        );

        if ($isUpdated) {
            $to = back()->getTargetUrl().'#'.$likableTypeAlias.'-'.$likableId;

            return redirect($to);
        }

        return back(301);
    }

    public function destroy(Request $request, Unlike $unlike): RedirectResponse
    {
        $request->validate([
            'likable_id' => ['required', 'integer'],
            'likable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $likableTypeAlias = $request->string('likable_type_alias');
        $likableId = $request->integer('likable_id');

        $isUnliked = $unlike->handle(
            $request->user(),
            $this->getMorphable->handle($likableTypeAlias, $likableId)
        );

        if ($isUnliked) {
            $to = back()->getTargetUrl().'#'.$likableTypeAlias.'-'.$likableId;

            return redirect($to);
        }

        return back(301);
    }
}
