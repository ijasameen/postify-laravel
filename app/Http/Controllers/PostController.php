<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class PostController extends Controller
{
    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
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

    public function show(Post $post, string $slug): View|RedirectResponse
    {
        $post
            ->loadCount(['likedUsers', 'savedUsers'])
            ->loadMissing([
                'user',
                'replies' => fn ($query) => $query
                    ->orderByDesc('created_at')
                    ->withCount(['likedUsers', 'savedUsers'])
                    ->with(['user', 'likedAuthenticatedUsers', 'savedAuthenticatedUsers']),
                'likedAuthenticatedUsers',
                'savedAuthenticatedUsers',
            ]);

        if ($post->slug !== $slug) {
            return to_route('posts.show', [
                'post' => $post->id,
                'slug' => $post->slug,
            ], status: 301);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Request $request, Post $post, string $slug): View|RedirectResponse
    {
        $post->load('user');

        abort_if($post->user->id !== $request->user()->id, 401, 'Your unauthorized to edit this post.');

        if ($post->slug !== $slug) {
            return to_route('posts.edit', [
                'post' => $post->id,
                'slug' => $post->slug,
            ], status: 301);
        }

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request): RedirectResponse
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

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $post = Post::query()->find($request->integer('id'));
        $user = $request->user();

        if (! $post) {
            abort(404);
        } elseif ($post->user_id !== $user->id) {
            abort(401, 'Your unauthorized to delete this post.');
        }

        $post->delete();

        return to_route('home', status: 301);
    }
}
