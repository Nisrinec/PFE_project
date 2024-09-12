@extends('layouts.app')

@section('title', 'Card Slider | Cosas Learning')

@section('content')
<div id="app">
    <div class="trending">
        <br>
        <h1>Trending</h1>
    </div>
    @if($trendingPosts->isEmpty())
        <p>No posts available.</p>
    @else
        <div class="hero_section">
            <div class="cards_box swiper">
                <div class="swiper-wrapper">
                    <!-- Card details -->
                    @foreach($trendingPosts as $post)
                        <section class="card_details swiper-slide">
                            <div class="card_img_box">
                                @if($post->image)
                                    <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="Post image">
                                @endif
                            </div>
                            <div class="card_data">
                                <h5 class="card_name">{{ $post->title }}</h5>
                                <br>
                                <a href="{{ route('posts.show', $post->id) }}" class="card_button">View Article</a>
                            </div>
                        </section>
                    @endforeach
                </div>
                <!-- Navigation buttons -->
                <div class="swiper-button-next">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <header>
            <h1>Cool Articles</h1>
        </header>
        <div class="band">
            <!-- Dynamic posts loop -->
            @foreach($posts as $post)
                <div class="item">
                    <a href="{{ route('posts.show', $post->id) }}" class="card">
                        @if($post->image)
                            <div class="thumb" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                        @endif
                        <article>
                            <h1>{{ $post->title }}</h1>
                            <span>{{ $post->author }}</span>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>
<br>
        <!-- New Section -->
        <section class="highlight_section">
            <div class="highlight_post">
                <br>
                <h1>In Case You Missed It</h1>
                <br>
                @if(isset($highlightedPost))
                    <a href="{{ route('posts.show', $highlightedPost->id) }}">
                        <div class="highlight_img" style="background-image: url('{{ asset('storage/' . $highlightedPost->image) }}');"></div>
                        <div class="highlight_content">
                            <h2>{{ $highlightedPost->title }}</h2>
                        </div>
                    </a>
                @endif
            </div>
            <div class="latest_posts">
                <br>
                <br>
                <br>
                <br>
                <ul>
                    @foreach($trendingPosts->slice(0, 12) as $post )
                        <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="divider"></div>
    @endif
</div>


<footer>
    @include('footer')
</footer>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    h1 {
        font-size: 36px; /* Increase the font size */
        font-family: 'Georgia', serif;
        font-weight: bold; /* Make the text bold */
        margin-bottom: 2px;
        margin-left: 1cm;
        color: #333; /* Ensure the text is a visible color */
    }

    header h1 {
        margin-top: 1cm;
        text-align: center; /* Adjust the margin for the "Cool Articles" title */
    }
.trending h1{
    display: flex;
    justify-content: center;  /* Centers horizontally */
    align-items: center;      /* Centers vertically */
}
    .cards_box {
        position: relative;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-wrapper {
        display: flex;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .card_details {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 300px;
        height: 400px;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        margin: 10px;
    }

    .card_img_box {
        flex: 2;
        overflow: hidden;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card_data {
        flex: 1;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card_name {
        font-size: 1.2em;
        margin: 0;
    }

    .card_description {
        color: #666;
        margin: 10px 0;
    }

    .card_button {
        display: inline-block;
        padding: 10px 15px;
        background-color: #ff0000;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .swiper-button-next,
    .swiper-button-prev {
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.5);
        width: 40px;
        height: 40px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .swiper-pagination-bullet {
        background-color: #ff0000;
    }

    .band {
        width: 90%;
        max-width: 1240px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        grid-gap: 20px;
    }

    @media (min-width: 30em) {
        .band {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (min-width: 60em) {
        .band {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .card {
        background: white;
        text-decoration: none;
        color: #444;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        min-height: 100%;
        transition: all 0.1s ease-in;
        position: relative;
        top: 0;
    }

    .card:hover {
        top: -2px;
        box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);
    }

    .thumb {
        padding-bottom: 60%;
        background-size: cover;
        background-position: center;
    }

    article {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    h1 {
        font-size: 20px;
        margin: 0;
        color: #333;
    }

    span {
        font-size: 12px;
        font-weight: bold;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 2em 0 0;
    }

    /* New section styling */
    .highlight_section {
        background-color: #303030;
        color: #fff;
        padding: 40px 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1cm;
    }

    .highlight_post {
        
        display: flex;
        flex-direction: column;
        margin-left: 0.5cm;
    }

    .highlight_img {
        background-size: cover;
        background-position: center;
        height: 400px;
        width:700px;
        margin-bottom: 10px;
    }

    .highlight_content {
        color: #fff;
    }

    .highlight_post h1 {
        color: #fff;
        font-size: 28px;
        margin: 0;
    }

    .highlight_content h2 {
        font-size: 24px;
        margin: 0;
    }

    .highlight_content p {
        font-size: 16px;
    }

    .latest_posts {
        flex: 1;
        max-width: 40%;
    }

    .latest_posts h3 {
        margin-bottom: 20px;
        font-size: 22px;
    }

    .latest_posts ul {
        list-style-type: none;
        padding: 0;
    }

    .latest_posts li {
        margin-bottom: 10px;
        border-bottom: 1px solid #fff;
    }

    .latest_posts li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }
    .divider {
    height: 1px;
    background-color: #fff;
    margin: 0;
}

</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.swiper', {
            slidesPerView: 3,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            loop: true,
            resizeObserver: true,
        });
    });
</script>
@endsection
