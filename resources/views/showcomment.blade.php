<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Calibri:400,300,700');
        
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #ffffff; 
            font-family: 'Calibri', sans-serif !important; 
        }
        
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            z-index: 1000; /* Ensure it stays on top */
            height: 60px; /* Adjust as needed */
        }
        
        .sidebar { 
            background-color: #f8f9fa; 
            padding: 20px; 
            border-right: 1px solid #ddd; 
            height: calc(100vh - 60px); /* Full height minus header height */
            overflow-y: auto; /* Adds scroll if content overflows */
            position: fixed;
            top: 190px; /* Start after the header */
            left: 0;
            width: 250px; /* Adjust width as needed */
            z-index: 999; /* Ensure it is below the header but above the content */
        }
        
        .sidebar h5 { 
            font-size: 1.25rem; 
            font-weight: 700; 
            margin-bottom: 20px; 
        }
        
        .sidebar a { 
            display: block; 
            padding: 10px 15px; 
            text-decoration: none; 
            color: #333; 
            border-radius: 4px; 
            margin-bottom: 10px; 
        }
        .side a { 
        display: block; 
        padding: 10px 15px; 
        text-decoration: none; 
        color: #ff0000; 
        border-radius: 4px; 
        margin-bottom: 10px; 
    }
    
        .sidebar a:hover { 
            background-color: #e9ecef; 
            color: #ff0000; 
        }
        
        .sidebar a.active { 
            background-color: #ff0000; 
            color: #ffffff; 
        }
        
        .sidebar .list-group-item { 
            border: none; 
            border-radius: 0; 
        }
        
        .content { 
            margin-left: 250px; /* Space for the sidebar */
            padding: 15px; 
            margin-top: 60px; /* Start after the header */
        }
        
        .mt-100 { margin-top: 100px; }
        .mb-100 { margin-bottom: 100px; }
        .card { border: 0px solid transparent; border-radius: 0px; }
        .comment-row { margin: 10px 0; }
        .comment-text { padding-left: 15px; }
        .w-100 { width: 100% !important; }
        .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.76563rem; line-height: 1.5; }
        .btn-cyan { background-color: #27a9e3; border-color: #27a9e3; }
        .btn-cyan:hover { background-color: #1a93ca; border-color: #198bbe; }
        .comment-widgets .comment-row:hover { background: rgba(0, 0, 0, 0.05); }
        .rounded-circle { border-radius: 50%; }
    </style>
    <script>
        function toggleEditForm(commentId) {
            const displayDiv = document.getElementById('display-' + commentId);
            const editForm = document.getElementById('edit-form-' + commentId);
            displayDiv.style.display = displayDiv.style.display === 'none' ? 'block' : 'none';
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <header class="header">
        @include('header')
    </header>
    <div class="sidebar">
        <h5>Settings</h5>
        <a href="{{ url('/settings/reply') }}">Notifications</a>
        <a href="{{ route('likedposts.likedPosts') }}">Liked Posts</a>
        <div class="side">
        <a href="{{ url('/showcomment') }}">Your Comments</a>
    </div>
    </div>
    <div class="content mt-100 mb-100">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">Your Comments</h4>
            </div>
            <div class="comment-widgets">
                @foreach ($comments as $comment)
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2">
                        <img class="rounded-circle" alt="User Avatar" src="{{ $comment->user->picture ? asset('storage/public/' . $comment->user->picture) : asset('images/profile-icon.png') }}" width="50">
                    </div>
                    <div class="comment-text w-100">
                        <!-- Display View -->
                        <div id="display-{{ $comment->id }}">
                            <a href="{{ route('posts.show', $comment->post->id) }}" style="text-decoration: none; color: inherit;">
                                <h6 class="font-medium">{{ $comment->user->name }}</h6>
                                <p>{{ $comment->content }}</p>
                            </a>
                            <div class="comment-footer">
                                <span class="text-muted float-right">{{ $comment->created_at->format('M d, Y') }}</span>
                                <button type="button" class="btn btn-cyan btn-sm" onclick="toggleEditForm({{ $comment->id }})">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">Delete</button>
                            </div>
                        </div>
                        <!-- Inline Edit Form -->
                        <div id="edit-form-{{ $comment->id }}" style="display: none;">
                            <form action="{{ route('showcomment.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h6 class="font-medium">{{ $comment->user->name }}</h6>
                                <textarea name="content" class="form-control mb-2">{{ $comment->content }}</textarea>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">{{ $comment->created_at->format('M d, Y') }}</span>
                                    <button type="submit" class="btn btn-cyan btn-sm">Save</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">Delete</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $comment->id }})">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- Delete Form -->
                        <form id="delete-form-{{ $comment->id }}" action="{{ route('showcomment.destroyy', $comment->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
