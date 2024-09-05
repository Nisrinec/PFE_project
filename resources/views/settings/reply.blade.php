<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment Notification</title>
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
    </style>
</head>
<header class="header">
    @include('header')
</header>
<body>
    <div class="sidebar">
        <h5>Settings</h5>
        <div class="side">
        {{-- <a href="#">Notifications</a> --}}
        <a href="{{ url('/settings/reply') }}">Notifications</a>
        <a href="{{ route('likedposts.likedPosts') }}">Liked Posts</a>
    </div>
        <a href="{{ url('/showcomment') }}">Your Comments</a>
    </div>
    
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<div class="notification-container">
    <div class="notification-header">Reply Notifications</div>
    @forelse ($notifications as $notification)
        <div class="notification-content">
            <p>{{ $notification->content }}</p>
            <p><small>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i') }}</small></p>
        </div>
        <hr>
    @empty
        <p>No notifications at this time.</p>
    @endforelse
</div>
</body>
</html>
</body>
</html>
