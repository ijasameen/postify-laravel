<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer'],
            'body' => ['required', 'string', 'min:6', 'max:500'],
        ]);

        $user = $request->user();
        $post = Post::find($request->integer('post_id'));

        if (! $post) {
            abort(404);
        }

        $post->replies()->create([
            'body' => $request->body,
            'user_id' => $user->id,
        ]);

        return to_route('posts.show', ['post' => $post->id, 'slug' => $post->slug], 301);
    }
}
