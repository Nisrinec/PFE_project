<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #fff;
  color: #000;
  font-size: 15px;
  line-height: 1.5;
}

a {
  color: #262626;
  text-decoration: none;
}

ul {
  list-style: none;
}

.container {
  width: 90%;
  max-width: 1100px;
  margin: auto;
}

/* Nav */

.menu-btn {
  cursor: pointer;
  position: absolute;
  top: 20px;
  right: 30px;
  z-index: 2;
  display: none;
}

.btn {
  cursor: pointer;
  display: inline-block;
  border: 0;
  font-weight: bold;
  padding: 10px 20px;
  background: #262626;
  color: #fff;
  font-size: 15px;
}

.btn:hover {
  opacity: 0.9;
}

.dark {
  color: #fff;
}

.dark .btn {
  background: #f4f4f4;
  color: #333;
}

/* Showcase */
.showcase {
  width: 100%;
  height: 2cm;
  background-color: #fafafa;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding-bottom: 50px;
  margin-bottom: 20px;
}

.showcase h2, .showcase p {
  margin-bottom: 10px;
}

.showcase .btn {
  margin-top: 20px;
}

/* Home cards */
.home-cards {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 20px;
  margin-bottom: 40px;
}

.home-cards img {
  width: 100%;
  margin-bottom: 20px;
}

.home-cards h3 {
  margin-bottom: 5px;
}

.home-cards a {
  display: inline-block;
  padding-top: 10px;
  color: #ff0000;
  text-transform: uppercase;
  font-weight: bold;
}

.home-cards a:hover i {
  margin-left: 10px;
}

/* Xbox */
.xbox {
  width: 100%;
  height: 350px;
  background: url('https://i.ibb.co/tBJGPD9/xbox.png') no-repeat center center/cover;
  margin-bottom: 20px;
}

.xbox .content {
  width: 40%;
  padding: 50px 0 0 30px;
}

.xbox p, .carbon p {
  margin: 10px 0 20px;
}

/* Carbon */
.carbon {
  width: 100%;
  height: 350px;
  background: url('https://i.ibb.co/72cgtsz/carbon.jpg') no-repeat center center/cover;
}

.carbon .content {
  width: 55%;
  padding: 100px 0 0 30px;
}

/* Follow */
.follow {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  margin: 30px 0 30px;
}

.follow * {
  margin-right: 10px;
}

/* Links */
.links {
  background: #f2f2f2;
  color: #616161;
  font-size: 12px;
  padding: 35px 0;
}

.links-inner {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  grid-gap: 10px;
  align-items: flex-start;
  justify-content: center;
}

.links li {
  line-height: 2.8;
}



</style>
</head>
<body>
    <header>
        @include('header')
    </header>
    <div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    
    <header class="showcase">
      <h1>{{ $categorie }}</h1>
    </header>

    <!-- Home cards for Posts -->
    <section class="home-cards">
      @foreach($posts as $post)
          <div>
              @if($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" alt="Post image">
              @endif
              <h3>{{ \Illuminate\Support\Str::limit($post->title, 40, '...') }}</h3>
              <a href="{{ route('posts.show', $post->id) }}">View Article <i class="fas fa-chevron-right"></i></a>
          </div>
      @endforeach
  </section>

    <!-- Additional Home cards or sections can go here -->

    <br>
    </div>
</body>

<footer>
    @include('footer')
</footer>

<script>
    document.querySelector('.menu-btn').addEventListener('click', () => {
        document.querySelector('.main-menu').classList.toggle('show');
    });
</script>
</html>
