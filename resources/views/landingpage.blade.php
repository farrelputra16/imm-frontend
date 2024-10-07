@extends('layouts.app-landingpage')

<style>
    /* Section Hero Styling */
    .section-hero {
        min-height: 10vh;
        display: flex;
        align-items: center;
        padding-top: 80px;
        margin-bottom: 100px;
    }
    /* Adding smooth transition for the changing word */
#changing-word {
    color: #333;
    font-weight: bold;
    display: inline-block;
    transition: opacity 0.5s ease;
}

    /* General container styling with margin for spacing */
    .container {
        margin-top: 1px;
    }

    /* Heading Text Styling */
    .section-hero h1 {
        font-size: 3.5rem;
        line-height: 1.2;
        font-weight: bold;
        color: #333;
    }

    /* Paragraph Text Styling */
    .section-hero p {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* Button Styling */
    .section-hero .btn-success {
        background-color: #86D293;
        border: none;
        padding: 7px 30px;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        color: black;
        transition: all 0.3s ease;
    }

    .section-hero .btn-success i {
        margin-right: 8px;
        color: #FFC107;
    }

    .section-hero .btn-success:hover {
        background-color: #74b583;
        transform: scale(1.05);
    }

    /* Chair Image Animation Styling */
    .chair-image {
        max-height: 800px;
        width: auto;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-30px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .this-week-section {
    text-align: center;
    margin: 30px 0;
}

.highlight-title {
    font-size: 1.5rem; /* Perbesar ukuran judul */
    font-weight: bold;
    margin-bottom: 30px;
    color: #000;
}

.custom-card {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%; /* Make sure it stretches to fill its container */
}

.custom-card h3 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0;
    color: #333;
}

.custom-card p {
    font-size: 1rem;
    color: #6c757d;
}

.row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap; /* Ensure the elements wrap if screen size is small */
}

.stats-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    flex: 1 1 80%; /* Perbesar ukuran setiap card ke 30% */
    max-width: 100%; /* Ukuran maksimum setiap card */
    box-sizing: border-box; /* Ensure padding and border are included in width calculation */
    margin-bottom: 20px; /* Space between rows */
}

@media (max-width: 768px) {
    .stats-card {
        flex: 0 0 100%; /* On small screens, each card will take the full width */
        max-width: 100%;
    }
}



    /* Card Hover and Pointer Effects */
    .card-inner {
        border-radius: 10px;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 80%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer; /* Show pointer */
    }

    /* Hover Effect: Slight lift and shadow */
    .card-inner:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-inner img {
        max-width: 100%;
        height: auto;
    }

    .card-info {
        color: #5940CB;
        font-size: 1rem;
        margin-top: 15px;
        font-weight: 500;
    }

    /* Styling for making the whole card clickable */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    /* Crunchbase header styling */
    .header-crunchbase {
        margin-top:80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-crunchbase h1 {
        font-size: 4.5rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .header-crunchbase h1 span {
        color: #6256CA;
    }
    .image-crunchbase {
        max-width: 200px; /* Adjust image size */
        margin-right: 120px;
    }
    .card {
    margin-bottom: 30px; /* Memberikan jarak antar card */
}


    .news-item {
        display: flex;
        margin-bottom: 40px;
    }

    .news-item img {
        width: 100px;
        height: 100px;
        margin-right: 20px;
        border-radius: 10px;
    }

    .news-item .news-content {
        flex: 1;
    }

    .news-item .news-content h5 {
        font-size: 2rem;
        font-weight: bold;
    }

    .news-item .news-content p {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .news-item .news-content .date {
        font-size: 0.75rem;
        color: #adb5bd;
    }

    .stats-card {
        text-align: center;
        padding: 20px;
    }

    .stats-card h3 {
        font-size: 2rem;
        margin-bottom: 0;
    }
    .promo-card {
    margin-top :40px;
    background-color: #6256CA;
    color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    position: relative; /* To position extra images later */
    margin-bottom:70px;
}

.promo-card p {
    font-size: 0.8rem; /* Adjusted to be larger */
    color: #FFFFFF;
    text-align: left;
}

.promo-card h4 {
    font-size: 1.25rem;
    margin-bottom: 10px;
    color: #FFFFFF;
    text-align: left;
}

.promo-card .btn {
    font-size: 0.6rem;
    background-color: #86D293;
    color: #3F3F46;
    font-weight: bold;
    padding: 5px 15px; /* Adjusted for horizontal alignment */
    white-space: nowrap; /* Ensure text stays on one line */
    text-align: center;

}

.promo-images {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.promo-images img {
    width: 150px;
    height: 150px;
    border-radius: 5px;
    object-fit: cover;
}

/* Extra images outside the promo card */
/* Extra images outside the promo card */
.extra-images {
    position: absolute;
    bottom: -40px; /* Move extra images below the promo card */
    left: 90%;
    transform: translateX(-40%);
    display: flex;
    justify-content: center;
}

.extra-images img {
    width: 100px;
    height: 100px;
    border-radius: 2px;
    object-fit: cover;
    margin-left: -40px; /* Reduce the space between the images */
}



    .table th, .table td {
        vertical-align: middle;
    }

    .table td {
        font-size: 0.875rem;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-item .save-btn {
        color: #6c63ff;
        cursor: pointer;
    }

    .list-group-item .save-btn:hover {
        text-decoration: underline;
    }

    .btn-link {
        color: #6c63ff;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>

@section('content')
<!-- Section Hero -->
<div class="container">
    <div class="row section-hero">
        <!-- Left Side: Text Content -->
        <div class="col-md-6">
            <h1>Make Your Decision <br>
                <span id="changing-word">Faster.</span>
              </h1>
            <p>Make better decisions, faster, and more effectively, ensuring success in every aspect of your personal and professional life by focusing on clear goals, strategic planning, and continuous improvement.</p>
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>

        <!-- Right Side: Chair Image -->
        <div class="col-md-6 text-center">
            <img src="images/landingpage/chairfix.png" class="img-fluid chair-image" alt="Chair with icons">
        </div>
    </div>
</div>

<!-- Section with Cards -->
<div class="container section-cards">
    <div class="row">
        <!-- First Card -->
        <div class="col-md-4 mb-4">
            <div class="card-inner">
                <img src="images/landingpage/cardfix1.png" class="card-img-top" alt="Filters Image">
            </div>
            <p class="card-info">Discover companies with search and AI-powered recommendations</p>
        </div>

        <!-- Second Card -->
        <div class="col-md-4 mb-4">
            <div class="card-inner">
                <img src="images/landingpage/cardfix2.png" class="card-img-top" alt="Growth Outlook Image">
            </div>
            <p class="card-info">Stay informed with intelligent insights and real-time alerts</p>
        </div>

        <!-- Third Card -->
        <div class="col-md-4 mb-4">
            <div class="card-inner">
                <img src="images/landingpage/cardfix3.png" class="card-img-top" alt="Galax Image">
            </div>
            <p class="card-info">Take action at the right time with personalized workflow tools</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>
    </div>
</div>

<!-- Insights Section -->
<div class="container">
    <div class="header-crunchbase">
        <div>
            <h1>
                CRUNCHBASE<br>
                <span>INSIGHTS & ANALYSIS</span>
            </h1>
        </div>
        <div>
            <img src="images/landingpage/logocrunch.png" class="image-crunchbase" alt="Crunchbase Insights & Analysis Logo">
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Latest Events
                </div>
                <div class="card-body">
                    <div class="news-item">
                        @foreach ($events as $event )
                        <img alt="Insight image 1" src="images/landingpage/speed.jpeg" />
                        <div class="news-content">
                            <div class="date">
                                {{ $event->start }}
                            </div>
                            <h5>{{ $event->title }}</h5>
                            <p>{{ $event->topic }}</p>
                            <p>{{ $event->description }}</p>
                        </div>
                    </div>
                        @endforeach
                    <a class="btn-link" href="{{ route('events.index') }}">MORE EVENTS</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Featured Funding Rounds
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Organization name</th>
                                <th>Investments Amount</th>
                                <th>Departments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investors as $investor)
                            <tr onclick="window.location.href='{{ route('investors.show', $investor->id) }}'">
                                <td>{{ $investor ->org_name }}</td>
                                <td>{{ $investor ->number_of_investments }}</td>
                                <td>{{ $investor ->departments }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn-link" href="{{ route('investors.index') }}">SHOW ALL INVESTORS ></a>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-md-4">
            @foreach ($investments as $investment)
            <div class="this-week-section">
                <h2 class="highlight-title">This Week on IMM</h2>
                <div class="row">
                    <!-- Funding Rounds -->
                    <div class="col-md-6">
                        <div class="card stats-card custom-card">
                            <div class="card-body">
                                <h3>{{ $totalInvestments }}</h3>
                                <p>FUNDING ROUNDS</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Funding -->
                    <div class="col-md-6">
                        <div class="card stats-card custom-card">
                            <div class="card-body">
                                <h3>{{ $investment->amount }}</h3>
                                <p>TOTAL FUNDING</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Acquisitions Recorded -->
                    <div class="col-md-6">
                        <div class="card stats-card custom-card">
                            <div class="card-body">
                                <h3>{{ $investment->status }}</h3>
                                <p>ACQUISITIONS RECORDED</p>
                            </div>
                        </div>
                    </div>

                    <!-- Acquisitions Amount -->
                    <div class="col-md-6">
                        <div class="card stats-card custom-card">
                            <div class="card-body">
                                <h3>{{ $investment->id }}</h3>
                                <p>ACQUISITIONS AMOUNT</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            <div class="promo-card">
                <div class="row align-items-center">
                    <!-- Left Side: Text and Button -->
                    <div class="col-md-8">
                        <div class="card-body-promo">
                            <h4>You're missing out</h4>
                            <p>Upgrade to Crunchbase Pro to find and engage with key decision makers</p>
                            <button class="btn">START FREE TRIAL</button>
                        </div>
                    </div>

                    <!-- Right Side: Image -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="promo-images">
                            <img src="images/landingpage/icon-promo.png" alt="Promo Image 1">
                        </div>
                    </div>
                </div>

                <!-- Extra images below the promo card -->
                <div class="extra-images d-flex justify-content-between">
                    <img src="images/landingpage/bitcoin-promo.png" alt="Extra Image 1">
                    <img src="images/landingpage/bitcoin-promo.png" alt="Extra Image 2">
                </div>
            </div>

            <div class="card">
                <div class="card-header">Featured Searches and Lists</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Government Docs Submitted to UW <span>50</span></li>
                    </ul>
                    <a class="btn-link" href="#">ALL Featured Searches and Lists ></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Trending Companies</div>
                <div class="card-body">
                    @foreach ($companies as $company )
                    <ul class="list-group">
                        <li class="list-group-item">01. <img alt="Tesla Motors logo" src="https://placehold.co/30x30" /> {{ $company->nama }}</li>
                    </ul>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">Trending Peoples</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        @foreach ($people as $people )
                        <tbody>
                            <tr>
                                <td>{{ $people->name }}</td>
                                <td><img alt="Globex Corporation logo" src="https://placehold.co/30x30" /> {{ $people->role }}</td>
                                <td>{{ $people->location }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <a class="btn-link" href="#">SHOW ALL EVENTS ></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Array of words to rotate
    const words = ['Faster.', 'Better.', 'Effective.','Efficient.'];
    let wordIndex = 0;

    function changeWord() {
      const wordElement = document.getElementById('changing-word');
      wordElement.style.opacity = '0'; // Start fade out

      setTimeout(() => {
        wordElement.textContent = words[wordIndex]; // Change the word
        wordElement.style.opacity = '1'; // Fade in
        wordIndex = (wordIndex + 1) % words.length; // Loop through words
      }, 500); // Wait for fade out transition
    }

    // Change word every 2 seconds
    setInterval(changeWord, 2000);
  </script>

@endsection
