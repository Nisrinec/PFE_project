<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Fraunces:ital,wght@0,500;0,600;0,700;1,600&display=swap');

*,
*:after,
*:before {
	box-sizing: border-box;
}

@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Fraunces:ital,wght@0,500;0,600;0,700;1,600&display=swap');
        * {
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            font-family: "DM Sans", sans-serif;
            font-size: 1rem;
            line-height: 1.5;
            background-color: #fff;
            color: #484847;
            display: flex;
            flex-direction: column;
        }
        img {
            display: block;
            max-width: 100%;
        }
        .responsive-wrapper {
            width: 95%;
            max-width: 1900px;
            margin-left: auto;
            margin-right: auto;
        }
        main {
            flex: 1;
            padding-bottom: 5rem; /* Ensure space for the footer */
        }
        

	
	&:after, &:before {
		content: "";
		display: block;
		position: absolute;
		width: 20px;
		height: 2px;
		background-color: currentcolor;
		right: 0;
		top: 8px;
	}
	
	&:after {
		top: 16px;
		width: 12px;
		right: 8px;
	}


.page-title {
	padding-left: 1.5rem;
	padding-right: 1.5rem;
	display: flex;
	justify-content: center;
	h1 {
		font-size: 1.75rem;
		font-weight: 700;
		color: #ff0000;
		text-align: center;
		position: relative;
		
		
		&:after {
			content: "";
			display: block;
			position: absolute;
			width: 100%;
			bottom: -3px;
			height: 2px;
			background-color: currentcolor;
		}
	}
}

.magazine-layout {
	margin-top: 3rem;
	display: grid;
	grid-template-columns: repeat(5, 1fr);
	grid-row-gap: 2rem;
}

.magazine-column {
	padding: 0 1.5rem;
	grid-column: span 5;
	
	@media (min-width: 1200px) {
		grid-column: span 1;
		border-right: 1px solid #CCC;
		&:last-child {
			border-right: none;
		}
	}
	
	&:nth-child(2) {
		@media (min-width: 1200px) {
			grid-column: span 2;
		}
	}
}

.article {
	& + .article {
		padding-top: 2rem;
		margin-top: 2rem;
		border-top: 1px solid #ccc;
	}
}

.article-img {
	& + * {
		margin-top: 1rem;
	}
}

.article-link {
	color: inherit;
	text-decoration: none;
}

.article-title {
	font-family: "Fraunces", serif;
	font-weight: 900;
	line-height: 1.25;
	color: #000;

	&--large {
		font-size: 2rem;
		& + * {
			margin-top: 1.5rem;
		}
	}

	&--medium {
		font-size: 1.5rem;
		& + * {
			margin-top: 0.75rem;
		}
	}

	&--small {
		font-size: 1.25rem;
		& + * {
			margin-top: 0.75rem;
		}
	}
}

.article-link {
	color: inherit;
}

.mark {
	background-color: #f79a9a;
	&--secondary {
		background-color: #c2dddf;
	}
	
	&--tertiary {
		background-color: #F8E177;
	}
}

.article-excerpt,
.article-creditation {
	font-size: 1.125rem;
	line-height: 1.4;
	p + p {
		margin-top: 1.5rem;
	}
}

.article-author {
	display: flex;
	flex-wrap: wrap;
	margin-top: 1.5rem;
}

.article-author-img {
	width: 3rem;
	height: 3rem;
	border-radius: 12px;
	background-color: #323232;
	overflow: hidden;
	background-blend-mode: multiply;
	img {
	}

	& + .article-author-info {
		margin-left: 0.5rem;
	}
}

.article-author-info {
	line-height: 1.375;
	dl {
		margin-top: 0.25em;
	}

	dt {
		font-weight: 600;
	}

	dd {
		font-size: 0.875em;
	}
}

.article-category {
	font-weight: 500;
	margin-bottom: 1rem;
	display: block;
	svg {
		max-width: 1.5rem;
		margin-right: .5rem;
		vertical-align: middle;
	}
	
}

.article-podcast-player {
	display: flex;
	align-items: center;
	margin-bottom: 1rem;
	margin-top: 1.25rem;
}

.podcast-play-button {
	width: 2.25rem;
	height: 2.25rem;
	border-radius: 12px;
	border: 0;
	background-color: #000;
	margin-right: .5rem;
	svg {
		max-width: 1rem;
		max-height: 1rem;
		fill: #FFF;
	}
}

.podcast-progression {
	flex: 1;
	height: 8px;
	border-radius: 99em;
	background-color: #D9D4CD;
	background-image: linear-gradient(to right, #F99970 30%, #D9D4CD 30%, #D9D4CD 100%)
}

.podcast-time {
	font-weight: 500;
	font-size: 1.125rem;
	margin-left: .5rem;
}

:focus {
	outline: 0;
}
        </style>
    <title>Document</title>
</head>
<body>
    <header>
        @include('header')
    </header>
    <main class="responsive-wrapper">
        <div class="page-title">
            <h1>About Us</h1>
        </div>
        <div class="magazine-layout">
            <div class="magazine-column">
                <article class="article">
                    <h2 class="article-title article-title--large">
                        <a href="#" class="article-link">The News Tv<mark class="mark mark--primary"> Mission </mark> </a>
                    </h2>
                    <div class="article-excerpt">
                        <p>Our mission is clear: to inform, engage, and empower our readers with the latest news and insightful commentary. As the media landscape evolves,</p>
                        <p>News Tv remains dedicated to providing content that is not only informative but also thought-provoking.</p>
                    </div>
                   
                </article>             
            </div>
            <div class="magazine-column">
                <article class="article">
                    <figure class="article-img">
                        <img src="{{ asset('images/about.jpeg') }}" />
                    </figure>
                    <h2 class="article-title article-title--medium">
                        <a href="#" class="article-link">A New Era in News</a>
                    </h2>
                    <div class="article-excerpt">
                        <p>Founded in 2024, <mark class="mark mark--primary">News Tv</mark> emerged from a vision to redefine the news landscape. Our team of seasoned journalists and passionate writers set out to create a platform where accuracy and integrity come first. With a focus on global events, we aim to provide our readers with comprehensive and unbiased news coverage.</p>
                    </div>
                   
                </article>
            </div>
            <div class="magazine-column">
                <article class="article">
                    <figure class="article-img">
                        <img src="https://images.unsplash.com/photo-1512521743077-a42eeaaa963c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80" />
                    </figure>
                    <h2 class="article-title article-title--small">
                        <a href="#" class="article-link">The Future of News: <mark class="mark mark--secondary"> Our Vision</mark>for Tomorrow</a>
                    </h2>
                  
                </article>
                <article class="article">
                    <figure class="article-img">
                        
                    </figure>
                    <h2 class="article-title article-title--small">
                        <a href="#" class="article-link">Our Impact: Stories That Make a Difference</a>
                    </h2>
                  
                </article>
            </div>
            <div class="magazine-column">
                <article class="article">
                    <h2 class="article-title article-title--medium">
                        <a href="#" class="article-link">Get Involved</a>
                    </h2>
                    <div class="article-excerpt">
                        <p>We encourage our readers to engage with us through contact us form, and by providing feedback.</p>
                        <p> Your voice is important to us, and we strive to foster a community of informed and active readers.</p>
                    </div>
                   
                </article>
               
            </div>
        </div>
    </main> 
</body>
<footer>
    @include('footer')
</footer>
</html>