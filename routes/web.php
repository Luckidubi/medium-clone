<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ClapController;



Route::get('/@{username}', [PublicProfileController::class, 'show'])
->name('profile.show');

Route::get('/', [PostController::class, 'index'])
->name('dashboard');

Route::get('/posts', [PostController::class, 'index'])
->name('post.index');

Route::get('/category/{category}', [PostController::class, 'category'])
->name('post.category');

Route::get('/posts/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth'])->group(function () {


    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/@{username}/{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/follow/{user}', [FollowerController::class, 'followUnfollow'])->name('follow');

    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('profile.posts');

    Route::post('/clap/{post}', [ClapController::class, 'clap'])
    ->name('clap');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
