<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $user = auth()->user();
        $query = Post::with('user')
        ->where('published_at', '<=', now())
        ->withCount('claps')
        ->latest();
        if ($user) {
            $ids = $user->followings()->pluck('user_id')->toArray();
            $ids[] = $user->id; // Include the authenticated user
            $query->whereIn('user_id', $ids);
        }
        $posts = $query->paginate(10);
        return view('post.index', [

            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',

            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']

        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->user_id = auth()->id(); // Assuming the user is authenticated
        $post->published_at = $request->input('published_at');

        $image = $request->file('image');
        if ($image) {
            $imageName = $image->store('posts', 'public');
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        // Find the post by slug
        if (!$post) {
            abort(404, 'Post not found');
        }

        return view('post.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username, Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('post.index')->with('error', 'You are not authorized to edit this post.');
        }
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('post.index')->with('error', 'You are not authorized to update this post.');
        }

        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->published_at = $request->input('published_at');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->store('posts', 'public');
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('profile.posts')->with('success', 'Post updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('post.index')->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('profile.posts')->with('success', 'Post deleted successfully.');
    }

    public function category(Category $category)
    {
        $user = auth()->user();

        $query = $category->posts()
        ->where('published_at', '<=', now())
        ->with('user')
        ->withCount('claps')
        ->latest();
        if ($user) {
            $ids = $user->followings()->pluck('user_id')->toArray();
            $ids[] = $user->id; // Include the authenticated user
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->simplePaginate(5);
        return view('post.index', compact('posts'));
    }

    public function myPosts()
    {
        $posts = auth()->user()->posts()
        ->with('user')
        ->withCount('claps')
        ->latest()->simplePaginate(5);
        return view('post.index', compact('posts'));
    }

}
