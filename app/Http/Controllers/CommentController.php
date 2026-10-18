<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog) {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $blog->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        return redirect()->route('blog.show', $blog)->with('success', 'Comment posted!');
    }
}

