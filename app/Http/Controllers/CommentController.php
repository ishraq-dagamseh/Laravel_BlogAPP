<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Only logged-in users can add/delete comments
    }

    // Store new comment
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); // Only comment owner can delete
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
