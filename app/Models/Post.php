<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'categorie', 'description', 'user_id'];
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
   
// In Post.php
// public function likes()
// {
//     return $this->hasMany(like::class);
// }

// public function dislikes()
// {
//     return $this->hasMany(Dislike::class);
// }
public function userInteractions(): HasMany
{
    return $this->hasMany(PostUserInteraction::class);
}
public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }
    // Post.php
// public function user()
// {
//     return $this->belongsTo(User::class);
// }

public function user()
{
    return $this->belongsTo(User::class);
}

// public function likedByUsers(): BelongsToMany
// {
//     return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
// }

// public function likes(): BelongsToMany
// {
//     return $this->belongsToMany(User::class, 'post_likes');
// }

// public function dislikes(): BelongsToMany
// {
//     return $this->belongsToMany(User::class, 'post_dislikes');
// }
}


 

