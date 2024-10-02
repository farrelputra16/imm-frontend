@extends('layouts.app-landingpage')

@section('css')
<style>
    /* Section Hero Styling */
    .section-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding-top: 80px;
        margin-bottom: 100px;
    }

    /* General container styling with margin for spacing */
    .container {
        margin-top: 40px;
    }

    /* Heading Text Styling */
    .section-hero h1 {
        font-size: 5.5rem;
        line-height: 1.2;
        font-weight: bold;
        color: #333;
    }

    /* Paragraph Text Styling */
    .section-hero p {
        font-size: 3.2rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* Button Styling */
    .section-hero .btn-success {
        background-color: #86D293;
        border: none;
        padding: 12px 30px;
        font-size: 3rem;
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

    /* Chair Image Styling */
    .chair-image {
        max-height: 1500px;
        width: auto;
    }

    /* Responsive Design for Section Hero */
    @media (max-width: 768px) {
        .section-hero {
            flex-direction: column;
            text-align: center;
            padding-top: 50px;
        }

        .section-hero h1 {
            font-size: 2.5rem;
        }

        .chair-image {
            max-height: 800px;
            margin-top: 20px;
        }
    }

    @media (max-width: 576px) {
        .section-hero h1 {
            font-size: 2rem;
        }

        .section-hero p {
            font-size: 1rem;
        }

        .section-hero .btn-success {
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .chair-image {
            max-height: 600px;
        }
    }

    /* Card section styling */
    .section-cards {
        padding: 60px 0;
        text-align: center;
        margin-top: 40px;
    }

    .card-outer {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        min-height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
    }

    .card-outer:hover {
        transform: translateY(-10px);
    }

    .card-inner {
        border-radius: 10px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 80%;
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

    @media (max-width: 768px) {
        .section-cards {
            padding: 30px 0;
        }

        .card-outer {
            min-height: 350px;
        }

        .card-info {
            font-size: 0.9rem;
        }
    }

    /* Section 3 Styling */
    .section-title {
        padding: 60px 0;
        display: flex;
        align-items: center;
        margin-top: 60px;
    }

    /* Title Text Styling */
    .section-title h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #333;
        position: relative;
        line-height: 1.2;
        margin-bottom: 0;
    }

    /* Highlight for CRUNCHBASE */
    .section-title h1.crunchbase-text {
        color: #A0A0A0 !important;
    }

    .section-title h1.insights-text {
        color: #5940CB !important;
    }

    .section-title h1::before,
    .section-title h1 span::before {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background-color: #5940CB;
        position: absolute;
        bottom: -10px;
    }

    .section3-image {
        max-width: 70%;
        height: auto;
    }

    @media (max-width: 768px) {
        .section-title h1 {
            font-size: 2.5rem;
            text-align: center;
        }

        .section3-image {
            max-width: 50%;
            margin: 0 auto;
            display: block;
        }
    }

    @media (max-width: 576px) {
        .section-title h1 {
            font-size: 2rem;
        }

        .section3-image {
            max-width: 80%;
        }
    }

    .header {
        text-align: center;
        margin: 20px 0;
    }

    .header h1 {
        font-size: 2.5rem;
        color: #6c757d;
    }

    .header h1 span {
        color: #6c63ff;
    }

    .header img {
        width: 100px;
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
@endsection

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
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix1.png" class="card-img-top" alt="Filters Image">
                </div>
            </div>
            <p class="card-info">Discover companies with search and AI-powered recommendations</p>
        </div>

        <!-- Second Card -->
        <div class="col-md-4 mb-4">
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix2.png" class="card-img-top" alt="Growth Outlook Image">
                </div>
            </div>
            <p class="card-info">Stay informed with intelligent insights and real-time alerts</p>
        </div>

        <!-- Third Card -->
        <div class="col-md-4 mb-4">
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix3.png" class="card-img-top" alt="Galax Image">
                </div>
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
    <div class="header">
        <h1>
            CRUNCHBASE
            <span>INSIGHTS & ANALYSIS</span>
        </h1>
        <img alt="Crunchbase Insights & Analysis logo" src="images/landingpage/section3.png" />
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Latest Insights and Analysis
                </div>
                <div class="card-body">
                    <div class="news-item">
                        <img alt="Insight image 1" src="https://placehold.co/80x80" />
                        <div class="news-content">
                            <div class="date">
                                September 18, 2024
                            </div>
                            <h5>Lorem ipsum dolor sit amet</h5>
                            <p>Jane Cooper</p>
                            <p>As AI technology advances, it's putting ever-increasing strain on existing data centers and associated power sources.</p>
                        </div>
                    </div>
                    <a class="btn-link" href="#">MORE CRUNCHBASE NEWS</a>
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
                                <th>Transaction name</th>
                                <th>Lead investors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img alt="Tesla Motors logo" src="https://placehold.co/30x30" /> Tesla Motors</td>
                                <td>Globex Corporation INV-24398</td>
                                <td>IT Business Process</td>
                            </tr>
                            <tr>
                                <td><img alt="Adidas logo" src="https://placehold.co/30x30" /> Adidas</td>
                                <td>Initech INV-24792</td>
                                <td>Technical Documentation</td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn-link" href="#">SHOW ALL FUNDING ROUNDS ></a>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-md-4">
            <div class="card stats-card">
                <div class="card-body">
                    <h3>393</h3>
                    <p>FUNDING ROUNDS</p>
                    <h3>36.7B</h3>
                    <p>TOTAL FUNDING</p>
                </div>
            </div>

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
                <div class="card-header">Trending Profiles</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">01. <img alt="Tesla Motors logo" src="https://placehold.co/30x30" /> Tesla Motors <span class="save-btn">SAVE</span></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Upcoming Events</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>Event Name</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jan 19, 2020</td>
                                <td><img alt="Globex Corporation logo" src="https://placehold.co/30x30" /> Globex Corporation INV-24398</td>
                                <td>Lafayette, California</td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn-link" href="#">SHOW ALL EVENTS ></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
