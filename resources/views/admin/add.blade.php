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
    <title>Add Post</title>
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
        .container {
            max-width: 1000px;
            width: 100%;
            margin-top: -4%;
        }
        #contactus {
            font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
            background: #F9F9F9;
            padding: 25px;
            margin: 150px 0;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        #contactus h3 {
            display: block;
            font-size: 30px;
            font-weight: 300;
            margin-bottom: 10px;
        }
        #contactus input[type="text"],
#contactus input[type="file"],
#contactus textarea,
#contactus select {
    width: 100%;
    border: 1px solid #ccc;
    background: #FFF;
    margin: 0 0 5px;
    padding: 10px;
}

        #contactus button[type="submit"] {
            cursor: pointer;
            width: 100%;
            border: none;
            background: #ff0000;
            color: #FFF;
            margin: 0 0 5px;
            padding: 10px;
            font-size: 15px;
        }
        #contactus button[type="submit"]:hover {
            background: #ff0000;
        }
    </style>
</head>
<body>
    <div class="wrapper">
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
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="contactus" action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h3>Add Post</h3>
                <fieldset>
                    <input type="file" name="image" id="image" required>
                </fieldset>
                <fieldset>
                    <input type="text" name="title" id="title" placeholder="Title" required>
                </fieldset>
                <fieldset>
                    <label for="categorie">Choose a category:</label>
                    <select name="categorie" id="categorie" required>
                        <option value="" disabled selected>Select a category:</option>
                        <option value="1">Local News</option>
                        <option value="2">World</option>
                        <option value="3">Business</option>
                        <option value="4">Politics</option>
                        <option value="5">Sports</option>
                        <option value="6">Health</option>
                        <option value="7">Entertainment</option>
                    </select>
                </fieldset>
            
                <fieldset>
                    <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    <input type="hidden" name="description" id="description">
                </fieldset>
                <fieldset>
                    <button type="submit">Add</button>
                </fieldset>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editor = new toastui.Editor({
                el: document.getElementById('editor'),
                height: '400px',
                initialEditType: 'markdown',
                previewStyle: 'vertical',
                placeholder: 'Write something cool!',
            });

            document.getElementById('contactus').addEventListener('submit', function(e) {
                // Update the hidden field with the description from the editor
                document.getElementById('description').value = editor.getMarkdown();
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
