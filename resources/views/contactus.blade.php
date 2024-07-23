@extends('layouts.app')

@section('content')
<div id="app">
    <header-component></header-component>
    <section id="contact">
        <h1 class="section-header">Contact Us</h1>
        <div class="contact-wrapper">
            <!-- Left contact page -->
            <form id="contact-form" class="form-horizontal" role="form" method="POST" action="{{ route('contactus.store') }}">
                @csrf
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" placeholder="NAME" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>
                    </div>
                </div>
                <button class="btn btn-primary send-button" id="submit" type="submit" value="SEND">
                    <div class="alt-send-button">
                        <i class="fa fa-paper-plane"></i><span class="send-text">SEND</span>
                    </div>
                </button>
            </form>
            <!-- Left contact page -->

            <div class="direct-contact-container">
                <ul class="contact-list">
                    <li class="list-item"><i class="fa fa-map-marker fa-2x"><span class="contact-text place">Location:Tangier, State</span></i></li>
                    <li class="list-item"><i class="fa fa-map-marker fa-2x"><span class="contact-text place">Phone:+212 678456544</a></span></i></li>
                    <li class="list-item"><i class="fa fa-map-marker fa-2x"><span class="contact-text place">Email:hitmeup@gmail.com</a></span></i></li>
                </ul>
                <hr>
              
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    /* Include the CSS provided here */
    body {
        margin: 0;
        padding: 0;
        background-color: #B5B5B5;
        padding-bottom: 100px;
    }

    #app {
        background-color: transparent; /* Ensure the header is visible */
    }

    header-component {
        display: block;
        background-color: #fff; /* Adjust as needed */
        z-index: 10; /* Ensure the header is on top */
        width: 100%;
        position: fixed; /* Ensure the header is fixed at the top */
        top: 0;
    }

    #contact {
        width: 100%;
        height: 100%;
        padding-top: 100px; /* Adjust padding to avoid overlap with fixed header */
    }

    .section-header {
        text-align: center;
        margin: 0 auto;
        padding: 40px 0;
        font: 300 60px 'Oswald', sans-serif;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 6px;
    }

    .contact-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin: 0 auto;
        padding: 20px;
        position: relative;
        max-width: 840px;
    }

    .form-horizontal {
        max-width: 400px;
        font-family: 'Lato';
        font-weight: 400;
    }

    .form-control, 
    textarea {
        max-width: 400px;
        background-color: #B5B5B5;
        color: #fff;
        letter-spacing: 1px;
    }

    .send-button {
        background-color:#ff0000;
        margin-top: 15px;
        height: 34px;
        width: 400px;
        overflow: hidden;
        transition: all .2s ease-in-out;
    }

    .alt-send-button {
        width: 400px;
        height: 34px;
        transition: all .2s ease-in-out;
    }

    .send-text {
        display: block;
        margin-top: 10px;
        font: 700 12px 'Lato', sans-serif;
        letter-spacing: 2px;
    }

    .alt-send-button:hover {
        transform: translate3d(0px, -29px, 0px);
    }

    .direct-contact-container {
        max-width: 400px;
    }

    .contact-list {
        list-style-type: none;
        margin-left: -30px;
        padding-right: 20px;
    }

    .list-item {
        line-height: 4;
        color: #aaa;
    }

    .contact-text {
        font: 300 18px 'Lato', sans-serif;
        letter-spacing: 1.9px;
        color: #bbb;
    }

    .place {
        margin-left: 62px;
        color: #000;
    }

    .phone {
        margin-left: 56px;
        color: #000;
    }

    .gmail {
        margin-left: 53px;
        color: #000;
    }

    .contact-text a {
        color: #bbb;
        text-decoration: none;
        transition-duration: 0.2s;
    }

    .contact-text a:hover {
        color: #fff;
        text-decoration: none;
    }

    .social-media-list {
        position: relative;
        font-size: 22px;
        text-align: center;
        width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    .social-media-list li a {
        color: #fff;
    }

    .social-media-list li {
        position: relative; 
        display: inline-block;
        height: 60px;
        width: 60px;
        margin: 10px 3px;
        line-height: 60px;
        border-radius: 50%;
        color: #fff;
        background-color: rgb(27,27,27);
        cursor: pointer; 
        transition: all .2s ease-in-out;
    }

    .social-media-list li:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 60px;
        height: 60px;
        line-height: 60px;
        border-radius: 50%;
        opacity: 0;
        box-shadow: 0 0 0 1px #fff;
        transition: all .2s ease-in-out;
    }

    .social-media-list li:hover {
        background-color: #fff; 
    }

    .social-media-list li:hover:after {
        opacity: 1;  
        transform: scale(1.12);
        transition-timing-function: cubic-bezier(0.37,0.74,0.15,1.65);
    }

    .social-media-list li:hover a {
        color: #000;
    }

    .copyright {
        font: 200 14px 'Oswald', sans-serif;
        color: #555;
        letter-spacing: 1px;
        text-align: center;
    }

    hr {
        border-color: rgba(255,255,255,.6);
    }

    @media screen and (max-width: 850px) {
        .contact-wrapper {
            display: flex;
            flex-direction: column;
        }
        .direct-contact-container, .form-horizontal {
            margin: 0 auto;
        }  
        
        .direct-contact-container {
            margin-top: 60px;
            max-width: 300px;
        }    
        .social-media-list li {
            height: 60px;
            width: 60px;
            line-height: 60px;
        }
        .social-media-list li:after {
            width: 60px;
            height: 60px;
            line-height: 60px;
        }
    }

    @media screen and (max-width: 569px) {
        .direct-contact-container, .form-wrapper {
            float: none;
            margin: 0 auto;
        }   
        .form-control, 
        textarea {
            max-width: 300px;
            margin: 0 auto;
        }   
        .name, .email, textarea {
            width: 300px;
        }
        .direct-contact-container {
            max-width: 300px;
            margin-top: 20px;
            padding-right: 5%;   
        }
        .social-media-list {
            left: 0;
        }
        .social-media-list li {
            height: 55px;
            width: 55px;
            line-height: 55px;
            font-size: 2rem;
        }
        .social-media-list li:after {
            width: 55px;
            height: 55px;
            line-height: 55px;
        }
    }
</style>
@endsection
