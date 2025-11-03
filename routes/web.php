<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::patch('posts', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('posts/edit/{post}/{slug}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('replies', [ReplyController::class, 'destroy'])->name('replies.destroy');
    Route::post('likes', [LikeController::class, 'store'])->name('likes.store');
    Route::put('likes', [LikeController::class, 'update'])->name('likes.update');
    Route::delete('likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});

Route::get('posts/{post}/{slug}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
