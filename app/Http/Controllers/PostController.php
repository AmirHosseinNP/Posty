<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::withCount(['likes' => function (Builder $query) {
            $query->where('is_like', true);
        }])
            ->with(['user', 'likes'])
            ->latest()
            ->paginate(20);

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

    public function show(Post $post)
    {
        $post->loadCount(['likes' => function (Builder $query) {
            $query->where('is_like', true);
        }]);
        return view('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
