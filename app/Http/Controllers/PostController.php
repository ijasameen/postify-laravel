<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:6', 'max:120'],
            'summary' => ['required', 'string', 'max:300'],
        ]);

        $user = $request->user();
        $post = $user->posts()->create([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
        ]);

        return to_route('posts.show', [
            'post' => $post->id,
            'slug' => $post->slug,
        ], status: 301);
    }

    public function show(Post $post, string $slug)
    {
        $post->loadMissing('user');

        if ($post->slug != $slug) {
            return to_route('posts.show', [
                'post' => $post->id,
                'slug' => $post->slug,
            ], status: 301);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Request $request, Post $post, string $slug)
    {
        $post->load('user');

        if ($post->user != $request->user()) {
            abort(401, 'Your unauthorized to edit this post.');
        }

        if ($post->slug != $slug) {
            return to_route('posts.edit', [
                'post' => $post->id,
                'slug' => $post->slug,
            ], status: 301);
        }

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:6', 'max:120'],
            'summary' => ['required', 'string', 'max:300'],
        ]);

        $post = Post::with('user')->find($request->integer('id'));
        $user = $request->user();

        if (! $post) {
            abort(404);
        } elseif ($post->user->id !== $user->id) {
            abort(401, 'Your unauthorized to edit this post.');
        }

        $post->update([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
        ]);

        return to_route('posts.show', [
            'post' => $post->id,
            'slug' => $post->slug,
        ], status: 301);
    }

    public function destroy(Post $post)
    {
        //
    }
}
