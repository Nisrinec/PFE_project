<!-- resources/views/footer.blade.php -->
<footer id="footer" class="footer-distributed">

    <div class="footer-section footer-left">
        <h3>News<span>Tv</span></h3>
        <br>
        <p class="footer-description">Bringing you the latest headlines from around the globe, News TV delivers up-to-the-minute updates and in-depth coverage of the most important stories.</p>
    </div>
    <div class="footer-section footer-center">
        <br>
        <br>
        <br>
        <div class="footer-contact">
            <i class="fa fa-phone"></i>
            <p>+1.555.555.5555</p>
        </div>
        <div class="footer-contact">
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:support@company.com">support@company.com</a></p>
        </div>
        <div class="footer-contact">
            <i class="fa fa-map-marker"></i>
            <p><span>444 S. Cedros Ave</span> Solana Beach, California</p>
        </div>
    </div>

    <div class="footer-section footer-links">
        <br>
        <br>
        <br>
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
        </ul>
    </div>

    <div class="footer-section footer-categories">
        <br>
        <ul>
            <li><a href="/categorie/local-news">Local News</a></li>
            <li><a href="/categorie/world">World News</a></li>
            <li><a href="/categorie/Business">Business News</a></li>
            <li><a href="/categorie/Politics">Politics News</a></li>
            <li><a href="/categorie/Sports">Sports News</a></li>
            <li><a href="/categorie/Health">Health News</a></li>
            <li><a href="#">Entertainement News</a></li>
        </ul>
    </div>

</footer>

<style scoped>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,500,300,700);
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'); /* Ensure Font Awesome is included */

    .footer-distributed {
        background: #303030;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        box-sizing: border-box;
    }

    .footer-section {
        flex: 1;
        margin: 0 10px;
    }

    .footer-left h3 {
        color: #ffffff;
        font: normal 36px 'Open Sans', cursive;
        margin: 0;
    }

    .footer-left h3 span {
        color: #ff0000;
    }

    .footer-description {
        color: #cccccc;
        font-size: 14px;
        margin-top: 10px;
    }

    .footer-center {
        margin-left: 2.5cm;
        display: flex;
        flex-direction: column;
    }
.footer-links{
    margin-left: 3cm;
}
.footer-categories{
    margin-left: -1cm;
}
.footer-left{
    margin-left: 2cm;
}
    .footer-contact {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .footer-contact i {
        background-color: #444;
        color: #ffffff;
        font-size: 20px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        margin-right: 10px;
    }

    .footer-contact p {
        color: #ffffff;
        margin: 0;
    }

    .footer-contact p a {
        color: #ff0000;
        text-decoration: none;
    }

    .footer-links h4, .footer-categories h4 {
        
        color: #ffffff;
        margin-bottom: 10px;
    }

    .footer-links ul, .footer-categories ul {
        list-style: none;
        padding: 0;
    }

    .footer-links li, .footer-categories li {
        margin: 5px 0;
    }

    .footer-links a, .footer-categories a {
        color: #cccccc;
        text-decoration: none;
    }

    .footer-links a:hover, .footer-categories a:hover {
        text-decoration: underline;
    }

    @media (max-width: 880px) {
        .footer-distributed {
            flex-direction: column;
            align-items: center;
        }

        .footer-section {
            margin: 10px 0;
        }
    }
</style>
