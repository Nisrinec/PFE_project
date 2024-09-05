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
        .container {
            max-width: 500px;
            width: 100%;
            margin-top: -4%;
        }
        #contactus {
            font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
            background: #F9F9F9;
            padding: 25px;
            margin: 190px 230px;
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
<header class="header">
    @include('header')
</header>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h5>Settings</h5>
            {{-- <a href="#">Notifications</a> --}}
            <a href="{{ url('/settings/notification') }}">Notifications</a>
            <div class="side">
            <a href="{{ route('settings.addpost') }}">Add Post</a>
        </div>
        <a href="{{ route('user.posts') }}">Your Posts</a>
        </div>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="contactus" action="{{ route('addpost.stor') }}" method="post" enctype="multipart/form-data">
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
</body>
</html>
