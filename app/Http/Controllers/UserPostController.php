<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $user->loadCount(['receivedLikesOrDislikes as received_likes' => function (Builder $query) {
            $query->where('is_like', true);
        }]);

        $posts = $user->posts()
            ->withCount(['likes' => function (Builder $query) {
                $query->where('is_like', true);
            }])
            ->with(['user', 'likes'])
            ->latest()
            ->paginate(20);

        return view('users.posts.index', [
            'posts' => $posts,
            'user' => $user
        ]);
    }
}
