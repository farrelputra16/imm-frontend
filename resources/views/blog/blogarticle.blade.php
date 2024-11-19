@extends('layouts.app-imm')
@section('title', 'Detail Artikel')

@section('css')<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap');
body,
html {
    font-family: "Quicksand", sans-serif;
    padding-top: 30px;
}


/* Navbar */


/* Media query for responsiveness */

@media only screen and (max-width: 768px) {
    .brand-info,
    .footer-links,
    .social-media {
        flex-basis: 100%;
        /* Set width to 100% on small screens */
        text-align: center;
    }
   .blog-title {
    font-size: 20px;
    font-family: "Quicksand", sans-serif;
    font-weight: bold;
    margin: 0 auto;
    color: #000;
    margin-bottom: 10px;
    text-align: center;
}

    .content{
        margin: 30px;
    }
    .footer {
        width: 100%;
        left: 0;
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
    }
    .footer-nav ul {
        top: 30px;
        right: 86px;
    }
}

.ad-container {
    background: #d3d3d3;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 63px;
    position: relative;
    top: 50px;
}

.ad-content {
    font-size: 1.5rem;
    color: #4b0082;
}

.back-link {
    font-size: 1.2rem;
    color: #4b0082;
    margin-bottom: 20px;
}

.back-link a {
    text-decoration: none;
    color: inherit;
    display: flex;
    align-items: center;
}

.blog-detail {
    font-family: "Roboto", sans-serif;
    text-align: center;
    /* Center align text */
    margin: 0 auto;
    /* Center align container */
    max-width: 800px;
    /* Adjust the width as needed */
}

.content {
    font-size: 20px;
    font-weight: 500;
    font-family: "Quicksand", sans-serif;
}

.blog-title {
    font-size: 40px;
    font-family: "Quicksand", sans-serif;
    font-weight: bold;
    margin: 0 auto;
    max-width: 500px;
    color: #000;
    margin-bottom: 10px;
    text-align: center;
}

.blog-author,
.blog-date {
    font-size: 16px;
    color: #000;
}

.blog-author {
    margin-bottom: 5px;
}

.section-title {
    font-size: 24px;
    font-weight: 400;
    color: #000;
    margin-top: 20px;
}

ul {
    list-style-type: disc;
    padding-left: 20px;
    text-align: left;
    /* Align list items to the left */
}

.subscribe-container {
    background: #f0f0ff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    margin-top: 30px;
}

.subscribe-container p {
    margin: 0;
    font-size: 1.2rem;
    color: #333;
}


/* Efek loading */


/* Animasi umum untuk elemen lainnya */
</style>
</head>
@endsection
@section('content')

<body>
    <div class="container mt-5">
                <div class="back-link">
            <a href="/blog"><i class="fas fa-arrow-left mr-4"></i> Artikel</a>
        </div>
    </div>

    <div class="blog-detail mt-4">
        <h1 class="blog-title">{{ $post->title }}</h1>
        <p class="blog-author">Penulis: {{ $post->user->full_name }}</p>
        <p class="blog-date">{{ $post->created_at->format('d F Y') }}</p>
        <img src="{{ env('APP_BACKEND_URL') . '/images/' . $post->img }}" alt="Blog Image" class="img-fluid my-4">
        <div class="content text-justify">{!! $post->content !!}</div>
    </div>
</body>
@endsection
