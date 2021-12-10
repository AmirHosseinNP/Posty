<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        if ($post->isLikedBy(auth()->user()))
            return $this->destroy($post);

        $test = $post->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['msg' => 'liked']);
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return response()->json(['msg' => 'disliked']);
    }
}
