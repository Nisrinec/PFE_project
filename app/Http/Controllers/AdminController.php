<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        }

        return redirect()->route('admin.users')->with('error', 'User not found.');
    }
    public function viewPosts()
{
    // Fetch posts from the database
    $posts = Post::all();

    // Return the view with posts data
    return view('admin.posts', compact('posts'));
}
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
public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('admin.posts')->with('success', 'Post deleted successfully');
        }

        return redirect()->route('admin.posts')->with('error', 'Post not found');
    }
    public function show()
{
    // Retrieve all comments from the database
    $comments = Comment::all();

    // Pass the comments to the view
    return view('/admin/comments', compact('comments'));
}

public function destroyy($id)
{
    $comment = Comment::with('replies')->findOrFail($id);

    foreach ($comment->replies as $reply) {
        $reply->delete();
    }

    $comment->delete();

    return redirect()->route('admin.comments')->with('success', 'Comment and its replies deleted successfully.');
}
public function dashboard()
{
    $userCount = User::count();
    $postCount = Post::count();
    $commentCount = Comment::count();

    return view('admin', compact('userCount', 'postCount', 'commentCount'));
}
public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('admin.edit', compact('post'));
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

    return redirect()->route('admin.edit', $post->id)->with('success', 'Post updated successfully');
}

}
