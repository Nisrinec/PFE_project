<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Internship Finder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
       body {
    font-family: Arial;
    background-color: #a8a4a4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Ensures body takes full viewport height */
}



.content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding-top: 80px; /* Adjust based on header height and desired space */
    padding-bottom: 80px; /* Adjust based on footer height and desired space */
}

.footer {
    background-color: #303030; /* Or your desired color */
    color: #ffffff; /* Text color */
    padding: 20px; /* Adjust as needed */
    box-sizing: border-box;
    /* Optional: Add space at the top if needed */
}

.container {
    border-radius: 16px;
    max-width: 1180px;
    margin: 0 30px;
    background-color: white;
    padding: 20px; /* Ensure padding if needed */
    flex: 1;
}

/* Your other styles remain unchanged */
.inner-container {
    width: 800px;
    margin: 0 auto;
    display: flex;
    background-color: white;
    border-radius: 12px;
    padding: 30px;
}

/* Add space between header and content, and between content and footer */
.content-wrapper {
    padding-top: 50px; /* Adjust this value to control the space below the header */
    padding-bottom: 80px; /* Adjust this value to control the space above the footer */
}


        /* Your other styles remain unchanged */
       
        .tile1 {
            width: 350px;
        }

        .tile2 {
            flex: 1 1 auto;
            padding: 0px 40px;
            margin-left:2cm;
        }

        .tile1-heading {
            background: -webkit-linear-gradient(#ff0000, #444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            font-size: 1.5em;
        }

        .form-row {
            padding: 20px 0px 0px 0px;
        }

        .form-field {
            border-radius: 4px;
            width: 100%;
            padding: 15px;
            background-color: #f5f4fa;
            border: 0px;
        }

        .contact-image {
            padding: 10px;
            border-radius: 35px;
            border: 1px solid #a8a4a4;
            vertical-align: middle;
            margin-right: 20px;
            width: 16px;
            height: 16px;
        }

        textarea {
            height: 100px;
            font-family: Arial;
        }

        .btn {
            color: white;
            background: linear-gradient(to right, #444, #ff0000);
        }

        .tile2-image img {
            width: 200px;
            height: 200px;
            margin-left:1cm;
        }

        #menu-icon {
            display: none;
            float: right;
        }

        @media all and (max-width: 900px) {
            .inner-container {
                width: auto;
                display: block;
                margin: 30px auto;
            }
            .header-content {
                width: auto;
            }
            .tile1 {
                width: 100%;
            }
            .tile2 {
                padding: 0px;
            }
            .tile2-image img {
                width: 100%;
                height: auto;
            }
        }

        @media all and (max-width: 540px) {
            #header-right-menu {
                float: none;
                display: none;
            }
            #header-right-menu a {
                display: block;
                padding: 10px 0px;
            }

            #menu-icon {
                display: block;
                float: right;
            }
        }

        @media all and (max-width: 400px) {
            .container {
                padding: 10px;
            }
        }
        .form-row p{
            margin-left:1.5cm;
        }
    </style>
</head>

<body>
    <header class="header">
        @include('header')
    </header>

    <div class="content-wrapper">
        <div class="container">
            <div class="inner-container">
                <br>
                <div class="tile1">
                    <div class="tile1-heading">Get in touch</div>
                    <div class="form-row">We are here for you! How can we help?</div>
                    <form id="contact-form" class="form-horizontal" role="form" method="POST" action="{{ route('contactus.store') }}">
                        @csrf
                        <div class="form-row">
                            <input type="text" name="name" class="form-field" placeholder="Enter your name">
                        </div>
                        <div class="form-row">
                            <input type="text" name="email" class="form-field" placeholder="Enter your email address">
                        </div>
                        <div class="form-row">
                            <textarea name="message" class="form-field" placeholder="Go ahead we are listening..."></textarea>
                        </div>
                        <div class="form-row">
                            <input type="submit" class="form-field btn" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="tile2">
                    <div class="tile2-image">
                        <img src="images/call2.png">
                    </div>
                    <div>
                        <div class="form-row">
                            <img src="images/pho.png" class="contact-image"><span>+212 676680985</span>
                        </div>
                        <div class="form-row">
                            <img src="images/mms.jpg" class="contact-image"><span>newstvx2024@gmail.com</span>
                        </div>
                        <div class="form-row">
                            <img src="images/loca.jpg" class="contact-image"><span>Street Jamal Eddine al Afghani </span><p>90000, Tangier</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        @include('footer')
    </footer>

    <script>
        function toggleMenu() {
            var menuElement = document.getElementById("header-right-menu");
            if (menuElement.style.display === "block") {
                menuElement.style.display = "none";
            } else {
                menuElement.style.display = "block";
            }
        }
    </script>
</body>

</html>
