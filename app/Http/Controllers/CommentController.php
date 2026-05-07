<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store new comment
    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'photo_id' => $photo->id,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    // Delete comment (own comments only)
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted!');
    }
}