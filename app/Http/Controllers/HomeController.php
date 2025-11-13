<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;

final class HomeController extends Controller
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
