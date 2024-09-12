<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@toast-ui/editor/dist/toastui-editor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Post Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }



        .container {
            display: flex;
            flex-wrap: wrap;
            margin: 20px auto;
            max-width: 1200px;
            padding: 0 15px;
        }

        .main-content {
            flex: 3;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            flex: 1;
            margin-left: 20px;
        }

        .post-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .post-title {
            font-size: 2.5rem;
            margin-top: 0;
        }

        .post-subtitle {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #555;
        }

        .post-date {
            font-size: 1rem;
            color: #888;
            margin-bottom: 20px;
        }

        .post-content {
            line-height: 1.6;
        }

        .btn-group {
            margin-top: 20px;
        }
        
        .sidebar-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            margin-left: 1cm;
            color: #ff0000;
        }
        
        .sidebar-post {
            margin-bottom: 20px;
            margin-left: 1cm;
            margin-right: 0cm;
        }

        .sidebar-post img {
            width: 150%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar-post a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .comment-section {
            margin-top: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
        }

        .comment-form textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }

        .comment-form button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #ff0000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #969696;
        }

        .comments-list {
            margin-top: 20px;
        }

        .comment {
            /* border-bottom: 1px solid #ddd; */
            padding-bottom: 10px;
            margin-bottom: 10px;
            position: relative;
            padding-top: 10px;
        }

        .comment p {
            margin: 0;
            font-size: 1rem;
        }

        .comment strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .comment-date {
            font-size: 0.875rem;
            color: #555;
        }

        .nested-comment {
            margin-left: 20px;
        }

        .media img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .reply-link {
            display: inline-block;
            margin-top: 10px;
            color: #969696;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .reply-link:hover {
            text-decoration: underline;
        }

        .reply-form {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .reply-form textarea {
            height: 60px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .reply-form button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #ff0000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .reply-form button:hover {
            background-color: #0056b3;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .btn-like,
        .btn-dislike {
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .btn-like {
            color: #007bff;
        }

        .btn-dislike {
            color: #dc3545;
        }

        .btn-like.active,
        .btn-dislike.active {
            color: #333;
        }

        .btn-count {
            font-size: 1rem;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <header>
        @include('header')
    </header>
    <br>
    <div class="container">
        <div class="main-content">
            <article>
                <h1 class="post-title">{{ $post->title }}</h1>
                <br>
                <p class="post-author">
                    Posted by: {{ $post->user ? $post->user->name : 'Unknown' }}
                </p>
                <img src="{{ $post->image ? asset('storage/' . $post->image) : '' }}" class="post-image"
                    alt="{{ $post->title }}">
                <p class="post-date">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</p>
                <div class="post-content">
                    {!! \Illuminate\Support\Str::markdown($post->description) !!}
                </div>

                <!-- Like/Dislike Buttons -->
                <div class="btn-group">
                    <button class="btn-like" data-post-id="{{ $post->id }}" aria-label="Like"><i
                            class="fas fa-thumbs-up"></i></button>
                    <span class="btn-count"
                        id="like-count-{{ $post->id }}">{{ $post->userInteractions->where('liked', 1)->count() }}</span>
                    <button class="btn-dislike" data-post-id="{{ $post->id }}" aria-label="Dislike"><i
                            class="fas fa-thumbs-down"></i></button>
                    <span class="btn-count"
                        id="dislike-count-{{ $post->id }}">{{ $post->userInteractions->where('disliked', 1)->count() }}</span>
                </div>
            </article>
            <!-- Comment Section -->
            <div class="comment-section">
                <p><b>Comments Section</b></p>
                <div class="comments-list">
                    @foreach ($post->comments as $comment)
                        <div class="comment border border-1 p-4 rounded-lg" id="comment-{{ $comment->id }}">
                            <div class="media">
                                <img class="mr-3 rounded-circle" alt="User Avatar"
                                    src="{{ $comment->user->picture ? asset('storage/public/' . $comment->user->picture) : asset('images/profile-icon.png') }}">
                                <div class="media-body">
                                    <div class="row ">
                                        <div class="col-8 d-flex align-items-center">
                                            <h5 class="mb-0">{{ $comment->user->name }}</h5>
                                            <span class="comment-date pl-2"> -
                                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <!-- Three-Dot Menu for Edit/Delete -->
                                            <div class="d-flex ">
                                                @auth
                                                    @if (auth()->id() === $post->user_id || auth()->id() === $comment->user_id)
                                                        <div class="dropdown">
                                                            <button class="btn btn-link dropdown-toggle" type="button"
                                                                id="commentOptions-{{ $comment->id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="commentOptions-{{ $comment->id }}">
                                                                @auth
                                                                    @if (auth()->id() === $comment->user_id)
                                                                        <a class="dropdown-item edit-comment-btn" href="#"
                                                                            data-comment-id="{{ $comment->id }}"
                                                                            data-comment-content="{{ $comment->content }}">Edit</a>
                                                                    @endif
                                                                @endauth
                                                                <form
                                                                    action="{{ route('comments.destroy', $comment->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endauth
                                                @auth
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <div class="pull-right reply">
                                                            <a href="#" class="reply-link"
                                                                data-comment-id="{{ $comment->id }}"><span><i
                                                                        class="fa fa-reply"></i> reply</span></a>
                                                        </div>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Comment Content -->
                                    <p>{{ $comment->content }}</p>

                                    <!-- Reply Link -->

                                    <!-- Nested comments -->
                                    @include('components/comment', ['comments' => $comment->replies])

                                    <!-- Reply Form -->
                                    @auth
                                        <div class="reply-form">
                                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <textarea name="content" required placeholder="Write your reply here..."></textarea>
                                                <button type="submit">Submit Reply</button>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- Main Comment Form -->
                @auth
                    <div class="comment-form">
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea name="content" required placeholder="Write your comment here..."></textarea>
                            <button type="submit">Submit Comment</button>
                        </form>
                    </div>
                @endauth
                @guest
                    <p>Please login</a> to like and comment.</p>
                @endguest
            </div>
        </div>
        <div class="sidebar">
            <h4 class="sidebar-title">Other Posts</h4>
            <div class="sidebar-post">
                @foreach ($otherPosts as $otherPost)
                    <div class="post-item">
                        <img src="{{ $otherPost->image ? asset('storage/' . $otherPost->image) : '' }}"
                            alt="{{ $otherPost->title }}">
                        <h5><a href="{{ route('posts.show', $otherPost->id) }}">{{ \Illuminate\Support\Str::limit($otherPost->title, 40, '...') }}</a></h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog"
        aria-labelledby="editCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-comment-form" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="comment_id" id="edit-comment-id" value="">
                        <div class="form-group">
                            <label for="edit-comment-content">Comment</label>
                            <textarea class="form-control" name="content" id="edit-comment-content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Show the reply form when the reply link is clicked
            $('.reply-link').click(function(e) {
                e.preventDefault();
                
                // Get the closest comment container
                // var $comment = $(this).('.comment');
                
                // Hide all .reply-form elements within this comment
                $('.reply-form').hide();
                
                // Toggle the visibility of the specific .reply-form
                // $(this).siblings('.reply-form').toggle();
                $(this).closest('.comment').find('.reply-form').last().toggle();

            });

            // Populate and show the edit comment modal
            $('.edit-comment-btn').click(function(e) {
                e.preventDefault();
                var commentId = $(this).data('comment-id');
                var commentContent = $(this).data('comment-content');
                var updateUrl = "/comments/" + commentId;

                $('#edit-comment-id').val(commentId);
                $('#edit-comment-content').val(commentContent);
                $('#edit-comment-form').attr('action', updateUrl);

                $('#editCommentModal').modal('show');
            });
        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Event listener for like button
        $('.btn-like').on('click', function() {
            const postId = $(this).data('post-id');
            const likeCountElement = $('#like-count-' + postId);
            const dislikeCountElement = $('#dislike-count-' + postId);

            $.ajax({
                url: `/posts/${postId}/like`,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        likeCountElement.text(response.likes_count);
                        dislikeCountElement.text(response.dislikes_count);
                    }
                },
                error: function(error) {
                    console.error('Error liking the post:', error);
                }
            });
        });

        // Event listener for dislike button
        $('.btn-dislike').on('click', function() {
            const postId = $(this).data('post-id');
            const likeCountElement = $('#like-count-' + postId);
            const dislikeCountElement = $('#dislike-count-' + postId);

            $.ajax({
                url: `/posts/${postId}/dislike`,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        likeCountElement.text(response.likes_count);
                        dislikeCountElement.text(response.dislikes_count);
                    }
                },
                error: function(error) {
                    console.error('Error disliking the post:', error);
                }
            });
        });
    </script>
</body>

</html>
