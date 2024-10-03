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

    /* Card Hover and Pointer Effects */
    .card-inner {
        border-radius: 10px;
        background-color: #fff;
        padding: 20px;
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-crunchbase h1 {
        font-size: 3.5rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .header-crunchbase h1 span {
        color: #6256CA;
    }
    .header-crunchbase
    .image-crunchbase {
        max-width: 200px; /* Adjust image size */
    }

    .news-item {
        display: flex;
        margin-bottom: 20px;
    }

    .news-item img {
        width: 80px;
        height: 80px;
        margin-right: 20px;
        border-radius: 10px;
    }

    .news-item .news-content {
        flex: 1;
    }

    .news-item .news-content h5 {
        font-size: 1rem;
        font-weight: bold;
    }

    .news-item .news-content p {
        font-size: 0.875rem;
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
        background-color: #6c63ff;
        color: #fff;
        text-align: center;
        padding: 20px;
        border-radius: 10px;
    }

    .promo-card p {
        color: black;
    }

    .promo-card h4 {
        font-size: 1.25rem;
        margin-bottom: 10px;
    }

    .promo-card .btn {
        background-color: #fff;
        color: #6c63ff;
        font-weight: bold;
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
            <h1>Make Better <br> Decisions, faster.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Exceptetur sint occaecat cupidatat.</p>
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
            <img src="images/landingpage/section3.png" class="image-crunchbase" alt="Crunchbase Insights & Analysis Logo">
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
            <div class="card stats-card">
                <div class="card-body">
                    <h3>{{ $totalInvestments}}</h3>
                    <p>FUNDING ROUNDS</p>
                    <h3>{{ $investment->amount }}</h3>
                    <p>TOTAL FUNDING</p>
                </div>
            </div>
            @endforeach

            <div class="card promo-card">
                <div class="card-body">
                    <h4>You're missing out</h4>
                    <p>Upgrade to Crunchbase Pro to find and engage with key decision makers</p>
                    <button class="btn">START FREE TRIAL</button>
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
@endsection
