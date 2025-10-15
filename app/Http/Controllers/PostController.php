<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Apply auth middleware for protected actions
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // List all posts (public)
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show single post (public)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show create form (optional if you use inline form in index)
    public function create()
    {
        return view('posts.create');
    }

    // Store new post (logged-in users only)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Auth::user()->posts()->create($request->only('title', 'body'));

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show edit form
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Only owner can edit
        return view('posts.edit', compact('post'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post->update($request->only('title', 'body'));

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
