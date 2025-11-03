<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::withCount(['replies', 'likedUsers'])
            ->orderByDesc('created_at')
            ->with([
                'user',
                'likedUsers' => function ($query) {
                    return $query->where('user_id', Auth::id());
                },
            ])
            ->get();

        return view('home', ['posts' => $posts]);
    }
}
