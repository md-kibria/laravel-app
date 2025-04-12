<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::orderBy('id', 'desc')->get();

        return view('admin.posts.comments', compact('comments'));
    }

    public function store(Post $post, Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        $data = $request->all();
        $data['post_id'] = $post->id;

        if(Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $post->update(['comments_count' => (int)$post->comments_count+1]);

        Comment::create($data);

        return redirect()->back()->with('success', 'Comment saved successfully');
    }

    public function update(Comment $comment) {
        $comment->update(['is_approved' => !$comment->is_approved]);

        return redirect()->back()->with('success', 'Comment visibility saved successfully');
    }
}
