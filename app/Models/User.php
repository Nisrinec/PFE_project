<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'picture',
        'name',
        'phone',
        'role_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function comments()
{
    return $this->hasMany(Comment::class);
}
// User.php
// User.php
// public function likedPosts(): BelongsToMany
// {
//     return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
// }

public function dislikedPosts()
{
    return $this->belongsToMany(Post::class, 'dislikes');
}
// In User.php
public function hasLiked(Post $post)
{
    return $post->likes()->where('user_id', $this->id)->exists();
}

public function hasDisliked(Post $post)
{
    return $post->dislikes()->where('user_id', $this->id)->exists();
}
public function likedPosts()
{
    return $this->belongsToMany(Post::class, 'post_user_interactions')
                ->wherePivot('liked', true);
}
public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
