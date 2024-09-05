<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@toast-ui/editor/dist/toastui-editor.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@toast-ui/editor/dist/toastui-editor-all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Your Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
            height: 60px;
        }

        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
            height: calc(100vh - 60px);
            overflow-y: auto;
            position: fixed;
            top: 200px;
            left: 0;
            width: 250px;
            z-index: 999;
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

        .sidebar a:hover {
            background-color: #e9ecef;
            color: #ff0000;
        }

        .sidebar a.active {
            background-color: #ff0000;
            color: #ffffff;
        }

        .content {
            margin-left: 270px;
            margin-top: 200px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
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
        .side a { 
        display: block; 
        padding: 10px 15px; 
        text-decoration: none; 
        color: #ff0000; 
        border-radius: 4px; 
        margin-bottom: 10px; 
    }
    </style>
</head>
<body>
    <header class="header">
        @include('header')
    </header>

    <div class="wrapper">
        <div class="sidebar">
            <h5>Settings</h5>
            <a href="{{ url('/settings/notification') }}">Notifications</a>
            <a href="{{ route('settings.addpost') }}">Add Post</a>
            <div class="side">
            <a href="{{ route('user.posts') }}">Your Posts</a></div>
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
                                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('posts.delete', $post->id) }}" method="POST" style="display: none;">
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
</body>
</html>
