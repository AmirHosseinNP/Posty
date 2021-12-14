<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedFirstTimeBy($user)
    {
        return $this->likes()->onlyTrashed()
            ->where('user_id', $user->id)->doesntExist();
    }

    public function isLikedBy($user)
    {
        return $this->likes->contains(function ($like) use ($user) {
            return ($like->user_id === $user->id && $like->is_like == true);
        });
    }

    public function isDislikedBy($user)
    {
        return $this->likes->contains(function ($like) use ($user) {
            return ($like->user_id === $user->id && $like->is_like == false);
        });
    }
}
