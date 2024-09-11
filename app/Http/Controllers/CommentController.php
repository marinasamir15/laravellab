<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }

    public function store(Request $request, $postId)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to comment.');
        }

        // Validate the request data
        $request->validate([
            'body' => 'required|string',
        ]);

        // Find the post by ID
        $post = Post::findOrFail($postId);

        // Create a new comment instance
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id(); // Set the authenticated user's ID

        // Save the comment to the post using the polymorphic relation
        $post->comments()->save($comment);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
