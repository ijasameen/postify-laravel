<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function __invoke(): View
    {
        $posts = Post::query()->withCount(['replies', 'likedUsers', 'savedUsers'])->latest()
            ->with([
                'user',
                'likedAuthenticatedUsers',
                'savedAuthenticatedUsers',
            ])
            ->get();

        return view('home', ['posts' => $posts]);
    }
}
