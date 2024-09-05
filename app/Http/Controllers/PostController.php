<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostUserInteraction;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.add'); 
    }
   
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (optional)
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Check if an image was uploaded
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
    
        // Create a new post and assign the validated data
        $post = new Post();
        $post->image = $imageName; // Store the image name if an image was uploaded
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post added successfully!');
    }
//     public function show($id)
// {
    
//     $post = Post::findOrFail($id);
//     $otherPosts = Post::where('id', '!=', $id)->latest()->limit(5)->get(); // Fetch other posts excluding the current one
//     return view('posts.show', compact('post', 'otherPosts'));
// }
public function show($id)
{
    $post = Post::with('comments.user')->findOrFail($id);
    $comment = $post->comments->first();  // This might be null if there are no comments
    $otherPosts = Post::where('id', '<>', $id)->latest()->take(5)->get();
    
    return view('posts.show', compact('post', 'otherPosts', 'comment'));
}


    
public function index()
{
    // Fetch posts with their like count, sorted by like count in descending order
    $posts = Post::withCount('likes') // Ensure 'likes' is defined as a relationship in your Post model
        ->orderBy('likes_count', 'desc')
        ->get();

    return view('home', compact('posts'));
}

// public function lign()
//     {
//         return view('menu'); 
//     }
//     public function showMenu()
// {
//     $posts = Post::all(); // Assuming you have a Post model and you want to retrieve all posts
//     return view('menu', compact('posts'));
// }


public function categorie($categorie)
{
    $categorieId = null;
  
    if ($categorie === 'local-news') {
        $categorieId = 1;
    } elseif ($categorie === 'world') {
        $categorieId = 2;
    }
 elseif ($categorie === 'Business') {
    $categorieId = 3;
}
 elseif ($categorie === 'Politics') {
    $categorieId = 4;
}
elseif ($categorie === 'Sports') {
    $categorieId = 5;
}
 elseif ($categorie === 'Health') {
    $categorieId = 6;
}
 elseif ($categorie === 'Entertainment') {
    $categorieId = 7;
}
    // Add more categories as needed

    // Fetch posts with the specified categorie ID
    $posts = Post::where('categorie', $categorieId)->get();

    return view('menu', [
        'posts' => $posts,
        'categorie' => ucfirst(str_replace('-', ' ', $categorie)) 
    ]);
}
// PostController.php
// public function likedPosts()
// {
//     $user = Auth::user();
//     $likedPosts = $user->likedPosts; // Access relationship directly

//     return view('settings.likedposts', ['likedPosts' => $likedPosts]);
// }
public function likedPosts()
{
    $user = auth()->user();

    // Fetch liked posts by the user
    $likedPosts = Post::whereHas('userInteractions', function ($query) use ($user) {
        $query->where('user_id', $user->id)
              ->where('liked', true);
    })->get();

    // Pass the liked posts to the view
    return view('settings.likedposts', compact('likedPosts'));
}

// In PostController.php
// app/Http/Controllers/PostController.php
// app/Http/Controllers/PostController.php
public function like(Request $request, Post $post)
{
    $user = auth()->user();
    $interaction = PostUserInteraction::where('post_id', $post->id)
        ->where('user_id', $user->id)
        ->first();

    if ($interaction) {
        if ($interaction->liked) {
            // If already liked, remove like
            $interaction->delete();
        } else {
            // Remove dislike if exists
            $interaction->disliked = false;
            $interaction->liked = true;
            $interaction->save();
        }
    } else {
        PostUserInteraction::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'liked' => true,
            'disliked' => false,
        ]);
    }

    // Update counts after changes
    $likes_count = PostUserInteraction::where('post_id', $post->id)
        ->where('liked', true)
        ->count();
    $dislikes_count = PostUserInteraction::where('post_id', $post->id)
        ->where('disliked', true)
        ->count();

    $post->update([
        'likes_count' => $likes_count,
        'dislikes_count' => $dislikes_count,
    ]);

    return response()->json([
        'success' => true,
        'likes_count' => $likes_count,
        'dislikes_count' => $dislikes_count,
        'liked' => $interaction ? $interaction->liked : true,
        'disliked' => $interaction ? $interaction->disliked : false,
    ]);
}


public function dislike(Request $request, Post $post)
{
    $user = auth()->user();
    $interaction = PostUserInteraction::where('post_id', $post->id)
        ->where('user_id', $user->id)
        ->first();

    if ($interaction) {
        if ($interaction->disliked) {
            // If already disliked, remove dislike
            $interaction->delete();
        } else {
            // Remove like if exists
            $interaction->liked = false;
            $interaction->disliked = true;
            $interaction->save();
        }
    } else {
        PostUserInteraction::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'liked' => false,
            'disliked' => true,
        ]);
    }

    // Update counts after changes
    $likes_count = PostUserInteraction::where('post_id', $post->id)
        ->where('liked', true)
        ->count();
    $dislikes_count = PostUserInteraction::where('post_id', $post->id)
        ->where('disliked', true)
        ->count();

    $post->update([
        'likes_count' => $likes_count,
        'dislikes_count' => $dislikes_count,
    ]);

    return response()->json([
        'success' => true,
        'likes_count' => $likes_count,
        'dislikes_count' => $dislikes_count,
        'liked' => $interaction ? $interaction->liked : false,
        'disliked' => $interaction ? $interaction->disliked : true,
    ]);
}
public function creat()
{
    return view('settings.addpost'); 
}
public function stor(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (optional)
        'title' => 'required|string|max:255',
        'categorie' => 'required',
        'description' => 'required|string',
    ]);

    // Check if an image was uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = null;
    }

    // Save the post to the database
    $post = new Post();
    $post->title = $request->title;
    $post->categorie = $request->categorie;
    $post->description = $request->input('description');
    $post->image = $imagePath;
    $post->user_id = auth()->id();
    $post->save();

    // Redirect with a success message
    return redirect()->back()->with('success', 'Post added successfully.');
}

public function showUserPosts()
{
    $user = auth()->user();
    $posts = Post::where('user_id', $user->id)->get();

    return view('settings.showpost', compact('posts'));
}
public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('user.posts')->with('success', 'Post deleted successfully');
        }

        return redirect()->route('user.posts')->with('error', 'Post not found');
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('settings.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $post->title = $request->input('title');
        $post->description = $request->input('description');
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }
    
        $post->save();
    
        return redirect()->route('settings.posts.edit', $post->id)->with('success', 'Post updated successfully');
    }
    
    
    


}







