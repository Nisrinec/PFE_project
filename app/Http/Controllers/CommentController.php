<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ReplyNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Notifications\NewCommentNotification;



class CommentController extends Controller
{
    // Store a new comment
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'content' => 'required|string',
    //         'post_id' => 'required|exists:posts,id',
    //     ]);
    
    //     // Create the comment
    //     Comment::create([
    //         'content' => $request->content,
    //         'user_id' => auth()->id(),  // This must be set correctly
    //         'post_id' => $request->post_id,
    //     ]);
    
    //     return redirect()->back()->with('success', 'Comment added successfully!');
    // }
//     public function store(Request $request, Post $post)
// {
//     $request->validate([
//         'content' => 'required|string|max:500',
//         'post_id' => 'required|exists:posts,id',
//         'parent_id' => 'nullable|exists:comments,id',
//     ]);

//     $comment = new Comment();
//     $comment->content = $request->content;
//     $comment->post_id = $request->post_id;
//     $comment->parent_id = $request->parent_id; // Set parent_id for replies
//     $comment->user_id = auth()->id();
//     $comment->save();

//     return redirect()->back()->with('success', 'Comment posted successfully');
// }
//-------------
// public function store(Request $request, $postId)
// {
//     // Validate the request input
//     $validatedData = $request->validate([
//         'content' => 'required|string',
//     ]);

//     // Retrieve the post and user
//     $post = Post::findOrFail($postId);
//     $user = auth()->user();

//     // Create and save the comment
//     $comment = new Comment();
//     $comment->content = $validatedData['content'];
//     $comment->user_id = $user->id;
//     $comment->parent_id = $request->parent_id; 
//     $comment->post_id = $postId;
//     $comment->save();

//     // Notify the post owner, but only if the commenter is not the post owner
//     if ($user->id !== $post->user_id) {
//         $postOwner = $post->user; // Assuming `user` is the relationship for the post's author
//         $postOwner->notify(new NewCommentNotification($comment->content, $postId, $user->name));
//     }

//     // Redirect or return success message
//     return redirect()->back()->with('success', 'Comment added successfully!');
// }

public function store(Request $request, $postId)
{
    // Validate the request input
    $validatedData = $request->validate([
        'content' => 'required|string',
    ]);

    // Retrieve the post and user
    $post = Post::findOrFail($postId);
    $user = auth()->user();

    // Create and save the comment or reply
    $comment = new Comment();
    $comment->content = $validatedData['content'];
    $comment->user_id = $user->id;
    $comment->parent_id = $request->parent_id; 
    $comment->post_id = $postId;

    // Check if it's a reply (parent_id is present)
    if ($request->has('parent_id')) {
        $comment->parent_id = $request->parent_id;

        // Notify the owner of the parent comment (reply notification)
        $parentComment = Comment::findOrFail($request->parent_id);
        if ($parentComment->user_id !== $user->id) {
            // Only send notification if the user is not replying to their own comment
            ReplyNotification::create([
                'user_id' => $parentComment->user_id,
                'comment_id' => $comment->parent_id,
                'post_id' => $postId,
                'content' => "{$user->name} replied to your comment: \"{$comment->content}\"",
            ]);
        }
    }

    $comment->save();

    // Notify the post owner about the new comment (if it's not the post owner themselves)
    $postOwner = $post->user;
    if ($postOwner->id !== $user->id) {
        ReplyNotification::create([
            'user_id' => $postOwner->id,
            'comment_id' => $comment->id,
            'post_id' => $postId,
            'content' => "{$user->name} commented on your post: \"{$comment->content}\"",
        ]);
    }

    // Redirect or return success message
    return redirect()->back()->with('success', 'Comment added successfully!');
}


    

    // Show all comments for the authenticated user
    public function index()
    {
        $comments = Auth::user()->comments;
        return view('showcomment', compact('comments'));
    }

    // Edit comment form
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view('showcomment.edit', compact('comment'));
    }

    // Update comment
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->content = $request->content;
        $comment->save();

        // return redirect()->route('showcomment.index')->with('success', 'Comment updated successfully.');
        return redirect()->back();
    }
   
    

    // Delete comment and its replies
    public function destroyy($id)
    {
        $comment = Comment::with('replies')->findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        foreach ($comment->replies as $reply) {
            $reply->delete();
        }

        $comment->delete();

        return redirect()->route('showcomment.index')->with('success', 'Comment and its replies deleted successfully.');
    }

    // Additional methods
    public function show()
    {
        $comments = auth()->user()->comments; 
        return view('showcomment', compact('comments'));
    }
    public function showw()
    {
        $notifications = Auth::user()->notifications;

        // Return the view with notifications
        return view('settings.notification', compact('notifications'));
    }
    public function showe()
    {
        $user = auth()->user();
        $notifications = ReplyNotification::where('user_id', $user->id)
                                           ->orderBy('created_at', 'desc')
                                           ->get();

return view('settings.reply', compact('notifications'));
}
    public function editt($id)
    {
        $comment = Comment::find($id);
        return view('showcomment.edit', compact('comment'));
    }
    public function destroy($id)
{
    $comment = Comment::with('replies')->findOrFail($id);

    // Check if the authenticated user is the owner of the comment
    if (auth()->id() !== $comment->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    // Delete replies first
    foreach ($comment->replies as $reply) {
        $reply->delete();
    }

    // Delete the comment
    $comment->delete();

    return redirect()->back()->with('success', 'Comment and its replies deleted successfully.');
}
public function replyToComment(Request $request, $commentId)
{
    $validated = $request->validate([
        'content' => 'required|string|max:255',
    ]);

    // Create a new comment as a reply
    $reply = new Comment();
    $reply->content = $request->content;
    $reply->user_id = Auth::id();
    $reply->post_id = Comment::find($commentId)->post_id;
    $reply->parent_id = $commentId;
    $reply->save();

    // Notify the user who made the original comment
}

}
