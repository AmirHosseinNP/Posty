<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        if ($post->isLikedBy(auth()->user()))
            return $this->destroy($post);

        if ($post->isDislikedBy(auth()->user()))
            return $this->update($post);

        if ($post->isLikedFirstTimeBy(auth()->user())) {
            $post->likes()->create([
                'user_id' => auth()->id(),
                'is_like' => true,
            ]);

            Mail::to($post->user)->send(new PostLiked($post, auth()->user()));
        } else {
            $post->likes()->onlyTrashed()
                ->where('user_id', auth()->id())->restore();
        }

        return response()->json(['msg' => 'liked']);
    }

    public function update(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->update([
            'is_like' => true,
        ]);

        return response()->json(['msg' => 'dislike to like']);
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return response()->json(['msg' => 'like removed']);
    }
}
