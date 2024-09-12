<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $posts = Post::all();

    // Fetch trending posts based on likes
    $trendingPosts = Post::withCount('likes')
        ->orderBy('likes_count', 'desc')
        ->take(12)
        ->get();

        $highlightedPost = $posts->random();
    // Pass both variables to the view
     return view('home', compact('posts', 'trendingPosts', 'highlightedPost'));
    
}
}
