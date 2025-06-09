<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Display the public profile of a user.
     *
     * @param string $username
     * @return \Illuminate\View\View
     */
    public function show(string $username)
    {
        // Fetch the user by username
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        $posts = $user->posts()
        ->where('published_at', '<=', now())
        ->with('user')->latest()->paginate(10);
        // Return the view with the user's data
        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}
