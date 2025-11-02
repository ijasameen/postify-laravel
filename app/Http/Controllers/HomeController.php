<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')->get();

        return view('home', ['posts' => $posts]);
    }
}
