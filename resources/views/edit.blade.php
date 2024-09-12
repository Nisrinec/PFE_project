<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
            background: #a8a8a8;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ff0000;
        }

        .profile-button {
            background-color: #303030;
            box-shadow: none;
            border: none;
        }

        .profile-button:hover,
        .profile-button:focus,
        .profile-button:active {
            background: #ff0000;
            box-shadow: none;
        }

        .back:hover {
            color: #ff0000;
            cursor: pointer;
        }

        .labels {
            font-size: 11px;
        }

        .add-experience:hover {
            background: #303030;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8;
        }

        .back_btn {
            color: #2bc48a;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .back_btn img {
            height: 20px;
            margin-left: 15px;
        }
        
    </style>
</head>
<body>
<header>
    @include('header')
</header>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img id="profileImage" class="rounded-circle mt-5" width="150px" src="{{ Auth::user()->picture ? asset('storage/public/' . Auth::user()->picture) : asset('images/profile-icon.png') }}">
                <label for="fileInput" class="back_btn">
                    <img src="{{ asset('images/mod.png') }}" alt="back_btn">
                    <div class="upload-btn"></div>
                </label>
                {{-- <input type="file" id="fileInput" name="profile_picture" style="display: none;" onchange="previewImage(event)"> --}}
                <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                <span class="text-black-50">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- Profile Settings Form -->
        <div class="col-md-5 border-right">
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-3">
                        <input type="file" id="fileInput" name="profile_picture" style="display: none;" onchange="previewImage(event)">
                        <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" name="name" placeholder="Enter your full name" value="{{ Auth::user()->name }}"></div>
                        <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control" name="phone" placeholder="Enter your phone number" value="{{ Auth::user()->phone }}"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ Auth::user()->email }}"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </div>
            </form>
        </div>

        <!-- Password Update Form -->
        <div class="col-md-4">
            <form method="POST" action="{{ route('profil.updatePassword') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Edit Password</span>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <label class="labels">Current Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter your current password" required>
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="labels">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Enter your new password" required>
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit">Save Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer>
    @include('footer')
  </footer>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>
