<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::withCount(['replies', 'likedUsers', 'savedUsers'])
            ->orderByDesc('created_at')
            ->with([
                'user',
                'likedAuthenticatedUsers',
                'savedAuthenticatedUsers',
            ])
            ->get();

        return view('home', ['posts' => $posts]);
    }
}
