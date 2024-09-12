<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> <!-- Custom CSS -->
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .wrapper {
        display: flex;
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

    #content {
        width: 100%;
        padding: 20px;
    }

    .navbar {
        margin-bottom: 20px;
    }

    .collapse.show {
        display: block;
    }
</style>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Admin Picture">
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

        <!-- Page Content -->
        <div id="content">
            <div class="card-body text-center">
                <h4 class="card-title">All Posts</h4>
            </div>

            <div class="container mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Writer Name</th>
                            <th>Title</th>
                            <th>Date of Creation</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>View Post</th> <!-- New Column for viewing post -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user ? $post->user->name : 'Unknown' }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->created_at->format('F j, Y') }}</td>
                                <td>
                                    @if(Auth::user()->id === $post->user_id)
                                    <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                </td>
                                <td>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('admin.delete', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm">View Post</a> <!-- View post button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
