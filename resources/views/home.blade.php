@extends('layouts.app') <!-- Assuming you have a master layout -->

@section('content')
<div id="app">
    <header-component></header-component>
    <section class="home" id="home">
        <div class="container">
            <div class="content-box">
                <div class="content">
                    <h1><b>STM Group</b></h1>
                    <span><h5>Discover leading IT solutions and engineering excellence at STM Group, serving Morocco and Africa since 1998.</span></h5>
                    <a href="{{ url('/student/login') }}" class="btn">Let's begin ➔</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    .home {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust as needed */
        background: url('{{ asset('images/cover2.png') }}') no-repeat center center;
        background-size: cover;
        /* Add any additional background properties here */
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .content-box {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for content */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 60%; /* Adjust the width of the content box */
        margin-top: 30px; /* Adjust margin-top for spacing */
    }

    .content {
        max-width: 600px;
        margin: 0 auto;
    }

    .home h1 {
        font-size: 36px;
        color: #333;
        margin-bottom: 20px;
    }

    .home h5 {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    .home .btn {
        display: inline-block;
        background-color: #ff0000;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease-in-out;
    }

    .home .btn:hover {
        background-color: #333333;
    }

    /* Media query for smaller screens */
    @media screen and (max-width: 768px) {
        .container {
            flex-direction: column;
            text-align: center;
        }

        .content-box {
            width: 100%; /* Full width on smaller screens */
            margin-top: 20px; /* Adjust margin-top */
        }
    }
</style>
@endsection
