<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::withCount('replies')->orderByDesc('created_at')->with('user')->get();

        return view('home', ['posts' => $posts]);
    }
}
