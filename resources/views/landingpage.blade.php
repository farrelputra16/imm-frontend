@extends('layouts.app-landingpage')

@section('css')
<style>
    /* Section Hero Styling */
    .section-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding-top: 80px;
        margin-bottom: 80px; /* Space between hero and next section */
    }

    /* General container styling with margin for spacing */
    .container {
        margin-top: 40px; /* Add margin-top for spacing between sections */
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
        padding: 12px 30px;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        color: black;
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
        margin-top: 40px; /* Add margin-top for spacing */
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
        margin-top: 60px; /* Add margin-top for spacing */
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
            <img src="images/landingpage/chair.png" class="img-fluid chair-image" alt="Chair with icons">
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

<!-- Section 3 with Title and Smaller Image -->
<div class="container section-title">
    <div class="row">
        <!-- Left Side: Text Content -->
        <div class="col-md-6">
            <h1>
                <span class="crunchbase-text">CRUNCHBASE</span> <br>
                <span class="insights-text">INSIGHTS & ANALYSIS</span>
            </h1>
        </div>

        <!-- Right Side: Image -->
        <div class="col-md-6 text-center">
            <img src="images/landingpage/section3.png" class="img-fluid section3-image" alt="Insights & Analysis Image">
        </div>
    </div>
</div>
@endsection
