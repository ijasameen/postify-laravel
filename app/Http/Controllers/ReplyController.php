<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ReplyController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'post_id' => ['required', 'integer'],
            'body' => ['required', 'string', 'min:6', 'max:500'],
        ]);

        /** @var User */
        $user = $request->user();

        /** @var ?Post */
        $post = Post::query()->find($request->integer('post_id'));

        abort_unless($post !== null, 404);

        $post->replies()->create([
            'body' => $request->body,
            'user_id' => $user->id,
        ]);

        return to_route('posts.show', ['post' => $post->id, 'slug' => $post->slug], 301);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        /** @var ?Reply */
        $reply = Reply::with('post')->find($request->integer('id'));

        /** @var User */
        $user = $request->user();

        if (! $reply) {
            abort(404);
        } elseif ($reply->user_id !== $user->id) {
            abort(401, 'Your unauthorized to delete this reply.');
        }

        $reply->delete();

        return to_route('posts.show', ['post' => $reply->post->id, 'slug' => $reply->post->slug], 301);
    }
}
