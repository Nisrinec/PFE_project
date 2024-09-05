<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            flex-direction: row-reverse; /* Sidebar on the right */
        }

        #sidebar {
            background: #343a40;
            color: #fff;
            width: 250px;
            min-height: 100vh;
            padding: 20px;
        }

        #sidebar .sidebar-header {
            padding: 10px;
            text-align: center;
        }

        #sidebar .sidebar-header img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }

        #sidebar .sidebar-header h3 {
            margin-top: 10px;
            font-size: 18px;
        }

        #sidebar ul {
            padding: 0;
            list-style: none;
        }

        #sidebar ul li {
            padding: 10px;
        }

        #sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        #sidebar ul li a:hover {
            background: #575d63;
        }

        .content { 
            flex-grow: 1;
            padding: 15px;
            margin-top: 60px; /* Start after the header */
        }
        
        .mt-100 { margin-top: 1px; }
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
</head>
<body>
    <div class="wrapper">
        <!-- Comments Section -->
        <div class="content mt-100 mb-100">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title">All Comments</h4>
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
                                        <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Delete Form -->
                            <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroyy', $comment->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
            
                <img src="{{ asset('images/profile-icon.png') }}" alt="Admin Picture"> <!-- Update the image source accordingly -->
                <h3>Admin</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('admin') }}">Dashboard</a>
                </li>
                <li>
                    <a href="#userMenu" data-toggle="collapse" aria-expanded="false" aria-controls="userMenu">
                        Tables
                    </a>
                    <ul id="userMenu" class="collapse">
                        <li><a href="{{ route('admin.users') }}">View Users</a></li>
                        <li><a href="{{ route('admin.posts') }}">View Posts</a></li>
                        <li><a href="{{ route('admin.comments') }}">View Comments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#userMen" data-toggle="collapse" aria-expanded="false" aria-controls="userMen">
                       Settings
                    </a>
                    <ul id="userMen" class="collapse">
                        <li><a href="{{ route('admin.add') }}">Add Post</a></li>
                    </ul>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
