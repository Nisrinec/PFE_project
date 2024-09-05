@extends('layouts.app')

@section('content')
<div class="sidebar">
    <h5>Settings</h5>
    {{-- <a href="#">Notifications</a> --}}
    <a href="{{ url('/settings/reply') }}">Notifications</a>
    <div class="side">
    <a href="{{ route('likedposts.likedPosts') }}">Liked Posts</a>
</div>
    <a href="{{ url('/showcomment') }}">Your Comments</a>
</div>
<div class="content">
    @foreach ($likedPosts as $likedPost)
        <figure class="snip1418">
            <img src="{{ $likedPost->image ? asset('storage/' . $likedPost->image) : 'https://via.placeholder.com/315x200' }}" alt="{{ $likedPost->title }}"/>
            <figcaption>
                <h3>{{ $likedPost->title }}</h3>
                <div class="price">{{ $likedPost->created_at->format('F j, Y') }}</div>
            </figcaption>
            <a href="{{ route('posts.show', $likedPost->id) }}"></a>
        </figure>
    @endforeach
</div>
@endsection

@section('styles')
<style>
    /* General page layout */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        padding: 20px;
    }
    .content {
    margin-left: 250px; /* Space for the sidebar */
    padding: 15px;
    margin-top: 60px; /* Start after the header */
}

.content {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Space between cards */
    justify-content: space-between; /* Adjust space between cards */
}
    /* Sidebar styling */
    .sideba {
        width: 250px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-right: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sideba-title {
        font-size: 18px;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
    }

    .sidebar { 
        background-color: #f8f9fa; 
        padding: 20px; 
        border-right: 1px solid #ddd; 
        height: calc(100vh - 60px); 
        overflow-y: auto; 
        position: fixed;
        top: 190px; 
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

    /* Snip1418 Styles */
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .snip1418 {
        font-family: 'Raleway', Arial, sans-serif;
        position: relative;
        overflow: hidden;
        margin: 10px;
        min-width: 230px;
        max-width: 315px;
        width: 100%;
        background: #ffffff;
        text-align: left;
        color: #000000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-perspective: 20em;
        perspective: 20em;
    }
    .snip1418 {
    flex: 1 1 calc(33.333% - 20px); /* 3 cards per row with space for gaps */
    margin: 0; /* Reset margin */
    box-sizing: border-box; /* Ensure padding doesn't affect width */
}

.snip1418 img {
    width: 100%; /* Ensure image fills card */
    height: auto; /* Maintain aspect ratio */
}
    .snip1418 figcaption {
        padding: 20px;
    }
    .snip1418 h3,
    .snip1418 p {
        margin: 0;
    }
    .snip1418 h3 {
        font-size: 1.5em;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    .snip1418 p {
        font-size: 0.9em;
        letter-spacing: 1px;
        font-weight: 400;
    }
    .snip1418 .price {
        font-weight: 200;
        font-size: 1em;
        line-height: 48px;
        letter-spacing: 1px;
    }
    .snip1418 .price s {
        margin-right: 5px;
        opacity: 0.5;
        font-size: 0.9em;
    }
    .snip1418 a {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>
@endsection
