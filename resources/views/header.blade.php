@php
use Illuminate\Support\Facades\Auth;
@endphp

<header>
    <div class="container">
        <img src="{{ asset('images/logo.jpg') }}" href="{{ url('/home') }}" alt="Website Logo" class="logo">
        <nav id="main-menu">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">About Us</a></li>
                <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
                @if(Auth::check())
                <li><a href="{{ url('/profile') }}"></a></li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @endif
            </ul>
        </nav>
        @if(Auth::check() && Auth::user()->role_id == 1)
            <div class="profile-dropdown">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Profile Icon" class="profile-icon">
                <div class="dropdown-content">
                    <a href="{{ url('/profil') }}">Profile</a>
                    <a href="{{ url('/showcomment') }}">Settings</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        @elseif(Auth::check() && Auth::user()->role_id == 2)
            <div class="profile-dropdown">
                <img src="{{ asset('images/profile-icon.png') }}" alt="Profile Icon" class="profile-icon">
                <div class="dropdown-content">
                    <a href="{{ url('/profil') }}">Profile</a>
                    <a href="{{ route('settings.addpost') }}">Settings</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        @endif
    </div>
    
    <div id="menu-content">
        <div class="menu-categories">
            {{-- <a href="{{ url('/menu') }}">Local News</a>
            <a href="#">World</a> --}}
           <a href="{{ route('posts.categorie', 'local-news') }}">Local News</a></li>
            <a href="{{ route('posts.categorie', 'world') }}">World</a></li>
            <a href="{{ route('posts.categorie', 'Business') }}">Business</a>
            <a href="{{ route('posts.categorie', 'Politics') }}">Politics</a>
            <a href="{{ route('posts.categorie', 'Sports') }}">Sports</a>
            <a href="{{ route('posts.categorie', 'Health') }}">Health</a>
            <a href="{{ route('posts.categorie', 'Entertainment') }}">Entertainment</a>
        </div>
    </div>
</header>

<style scoped>
   header {
    background-color: #ffffff;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
}

.logo {
    height: 40px;
    margin-right: auto;
}

nav ul {
    list-style: none;
    margin-top: 20px;
    display: flex;
    gap: 35px;
}

nav ul li a {
    text-decoration: none;
    color: #000000;
    font-weight: bold;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #ff0000;
}

/* Ensure the dropdown is on top */
.profile-dropdown {
    position: relative; /* Necessary for z-index to work */
    display: inline-block;
    z-index: 30; /* Higher than #menu-content */
}

.profile-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    top: 100%; /* Position it directly below the profile icon */
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 30; /* Higher than #menu-content */
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.profile-dropdown:hover .dropdown-content {
    display: block;
}

/* Adjust menu-content to be below the dropdown */
#menu-content {
    background: rgb(255,255,255);
    background: linear-gradient(90deg, rgba(255,255,255,1) 19%, rgba(182,180,180,1) 66%, rgba(255,255,255,1) 100%);
    padding: 20px;
    margin-top:0.5cm;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    width: 100%;
    z-index: 20; /* Lower than dropdown-content */
    position: relative;
}

.menu-categories {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
}

.menu-categories a {
    color: black;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 15px;
    transition: color 0.3s;
}
.menu-categories a:hover {
    color: #ff0000;
}

    
</style>
