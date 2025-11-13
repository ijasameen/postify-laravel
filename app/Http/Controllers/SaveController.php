<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetMorphable;
use App\Actions\Savable\Save;
use App\Actions\Savable\ToggleSave;
use App\Actions\Savable\UnSave;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final class SaveController extends Controller
{
    public function __construct(
        protected GetMorphable $getMorphable,
    ) {}

    public function store(Request $request, Save $save)
    {
        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        $isLiked = $save->handle(
            $request->user(),
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isLiked) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }
        abort(404);

    }

    public function update(Request $request, ToggleSave $toggleSave)
    {
        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        $isUpdated = $toggleSave->handle(
            $request->user(),
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isUpdated) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }
        abort(404);

        return back(301);
    }

    public function destroy(Request $request, UnSave $unSave)
    {
        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        $isUnliked = $unSave->handle(
            $request->user(),
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isUnliked) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }
        abort(404);

        return back(301);
    }
}
