<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .notification-container {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 15px auto;
        }
        .notification-header {
            font-size: 18px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }
        .notification-content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .notification-content a {
            color: #ff0000;
            text-decoration: none;
        }
        .notification-content a:hover {
            text-decoration: underline;
        }
        .notification-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            text-align: right;
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
            top: 60px;
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
<header class="header">
    @include('header')
</header>
<body>
    <div class="sidebar">
        <br>
        <br><br><br><br>
        <h5>Settings</h5>
        <div class="side">
            <a href="{{ url('/settings/reply') }}">Notifications</a>
        </div>
        <a href="{{ route('likedposts.likedPosts') }}">Liked Posts</a>
        <a href="{{ url('/showcomment') }}">Your Comments</a>
    </div>
            <br><br>
<br><br>
<br><br>
<br><br>
<br><br>
            @forelse ($replyNotifications as $notification)
                <div class="notification-container">
                    <div class="notification-header">
                    <p>{{ $notification->content }}</p>
                    <div class="notification-content">
                        <p><a href="{{ url('/posts/' . ($notification->post_id ?? '#') . '#comment-' . ($notification->comment_id ?? '')) }}">View reply</a></p>
                    </div>
                    <div class="notification-footer">
                    <p><small>{{ \Carbon\Carbon::parse($notification->created_at)->format('F j, Y \a\t g:i A') }}</small></p>
                </div>
                </div>
               
            </div>
            @empty
                <p>No notifications at this time.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
