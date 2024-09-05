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
            flex: 1;
            padding: 20px;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .snip1418 {
            flex: 1 1 calc(33.333% - 20px);
            margin: 0;
            box-sizing: border-box;
            min-width: 230px;
            max-width: calc(33.333% - 20px);
            background: #ffffff;
            text-align: left;
            color: #000000;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            position: relative;
        }

        .snip1418 img {
            width: 100%;
            height: auto;
        }

        .snip1418 figcaption {
            padding: 20px;
            position: relative;
        }

        .snip1418 h3 {
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .snip1418 .price {
            font-weight: 200;
            font-size: 1em;
            line-height: 48px;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .snip1418 .card_button {
            display: inline-block;
            font-weight: bold;
            color: #ff0000;
            text-decoration: none;
            margin-top: 10px;
        }

        .snip1418 .card_button:hover {
            text-decoration: underline;
        }

        /* Three-dots menu styling */
        .menu {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        .menu .dots {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 30px;
            text-align: center;
            line-height: 1;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .dropdown a:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="wrapper">
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

        <!-- Page Content -->
        <div id="content">
            <div class="card-body text-center">
                <h4 class="card-title">All Posts</h4>
            </div>

            <div class="content">
                @if ($posts->isEmpty())
                    <p>You have not published any posts yet.</p>
                @else
                    @foreach ($posts as $post)
                        <figure class="snip1418">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/315x200' }}" alt="{{ $post->title }}"/>
                            <figcaption>
                                <div class="menu">
                                    <div class="dots" onclick="toggleDropdown(this)">...</div>
                                    <div class="dropdown">
                                        {{-- <a href="{{ route('admin.posts', $post->id) }}">Edit</a> --}}
                                        <a href="{{ route('admin.edit', $post->id) }}">Edit</a>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">Delete</a>
                                        <form id="delete-form-{{ $post->id }}" action="{{ route('admin.delete', $post->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                                <h3>{{ $post->title }}</h3>
                                <div class="price">{{ $post->created_at->format('F j, Y') }}</div>
                                <a href="{{ route('posts.show', $post->id) }}" class="card_button">View Article</a>
                            </figcaption>
                        </figure>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
 function toggleDropdown(element) {
            var dropdown = element.nextElementSibling;
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dots')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
        </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
