<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetMorphable;
use App\Actions\Savable\Save;
use App\Actions\Savable\ToggleSave;
use App\Actions\Savable\UnSave;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final class SaveController extends Controller
{
    public function __construct(
        private readonly GetMorphable $getMorphable,
    ) {}

    public function store(Request $request, Save $save): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user, 500, 'Something went wrong.');

        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        $isLiked = $save->handle(
            $user,
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isLiked) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }

        return back(301);
    }

    public function update(Request $request, ToggleSave $toggleSave): RedirectResponse
    {
        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        /** @var User */
        $user = $request->user();

        $isUpdated = $toggleSave->handle(
            $user,
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isUpdated) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }

        return back(301);
    }

    public function destroy(Request $request, UnSave $unSave): RedirectResponse
    {
        $request->validate([
            'savable_id' => ['required', 'integer'],
            'savable_type_alias' => ['required', 'string', Rule::in(array_keys(Relation::morphMap()))],
        ]);

        $savableTypeAlias = $request->string('savable_type_alias');
        $savableId = $request->integer('savable_id');

        /** @var User */
        $user = $request->user();

        $isUnliked = $unSave->handle(
            $user,
            $this->getMorphable->handle($savableTypeAlias, $savableId)
        );

        if ($isUnliked) {
            $to = back()->getTargetUrl().'#'.$savableTypeAlias.'-'.$savableId;

            return redirect($to);
        }

        return back(301);
    }
}
