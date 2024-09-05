<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> <!-- Custom CSS -->
</head>
<style>
/* public/css/admin.css */

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
    margin-left: 200px; /* Sidebar width + some space */
    padding: 20px;
    min-height: 100vh;
    background-color: #fff;
}



.container h2 {
    color: #343a40;
    margin-bottom: 30px;
}

/* Card Styles */
.card {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 200px; /* Fixed width */
    height: 200px; /* Fixed height to maintain square shape */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0 auto; /* Center align cards */
    margin-bottom: 20px; /* Adjust this value to control the gap between rows */
}

/* Adjust the gap between columns */
.row {
    display: flex;
    justify-content: space-around; /* Space out columns */
    flex-wrap: wrap; /* Allow wrapping */
}

.col-md-4 {
    display: flex;
    justify-content: center; /* Center align cards within columns */
    padding: 0 15px; /* Adjust this value to control the gap between columns */
}

/* Hover effect for cards */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.card .card-title {
    font-size: 18px;
    font-weight: bold;
}

.card .card-text {
    font-size: 16px;
}

/* Specific Widget Colors */
/* Specific Widget Colors */
/* Ensure specificity for widget colors */
.card.bg-primary {
    background-color: #343a40 !important; /* Blue for Primary */
    border: none;
}

.card.bg-success {
    background-color: #343a40 !important; /* Green for Success */
    border: none;
}

.card.bg-info {
    background-color: #343a40 !important; /* Teal for Info */
    border: none;
}

.card.bg-primary .card-title,
.card.bg-success .card-title,
.card.bg-info .card-title {
    color: #fff !important;
}

.card.bg-primary .card-text,
.card.bg-success .card-text,
.card.bg-info .card-text {
    color: #f8f9fa !important;
}
</style>
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
                <h4 class="card-title"></h4>
            </div>

            <div class="container mt-4">
                <h2>Welcome, Admin!</h2>
                <div class="row">
                    <!-- Widget 1: Number of Users -->
                   <!-- Widget 1: Number of Users -->
<div class="col-md-4">
    <div class="card bg-primary mb-3">
        <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text">{{ $userCount }}</p>
        </div>
    </div>
</div>

<!-- Widget 2: Number of Posts -->
<div class="col-md-4">
    <div class="card bg-success mb-3">
        <div class="card-body">
            <h5 class="card-title">Total Posts</h5>
            <p class="card-text">{{ $postCount }}</p>
        </div>
    </div>
</div>

<!-- Widget 3: Number of Comments -->
<div class="col-md-4">
    <div class="card bg-info mb-3">
        <div class="card-body">
            <h5 class="card-title">Total Comments</h5>
            <p class="card-text">{{ $commentCount }}</p>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
