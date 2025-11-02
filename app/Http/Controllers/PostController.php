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
        $post->load('user');

        if ($post->slug != $slug) {
            return to_route('posts.show', [
                'post' => $post->id,
                'slug' => $post->slug,
            ], status: 301);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
