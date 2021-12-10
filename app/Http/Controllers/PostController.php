<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(20);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required'],
        ]);

        auth()->user()->posts()->create($request->only('body'));

        return back();
    }
}
