@extends('layouts.app-investors')
@section('title', 'Halaman IMM')

@section('css')
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    /* Profile Header Styles */
    .profile-header {
        height: 181px;
        margin-top: 100px;
        background-color: #702DFF;
        color: white;
        padding: 20px;
        border-radius: 15px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .profile-header .info {
        display: flex;
        flex-direction: column;
    }

    .profile-header .info h1 {
        font-size: 2.5rem;
        margin: 0;
    }

    .profile-header .info h1 .fa-hand-wave {
        margin-left: 10px;
    }

    /* Circular Profile Image with White Border */
    .profile-image {
        position: absolute;
        right: 100px;
        bottom: -150px;
        width: 258px;
        height: 258px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Minimal Gap for Stats Section */
    .stats {
        margin-top: 40px;
        display: flex;
        gap: 2px;
        flex-wrap: wrap;
    }

    .stats .col-md-3,
    .stats .col-sm-4 {
        padding-left: 0;
        padding-right: 0;
    }

    .stats .stat {
        background-color: white;
        border-radius: 8px;
        padding: 15px;
        text-align: left;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        width: 220px;
        height: 80px;
        display: flex;
        align-items: center;
    }

    .stat img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        border-radius: 50%;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-content h3 {
        margin: 0;
        font-size: 1rem;
        color: #5F5F5F;
    }

    .stat-content p {
        margin: 3px 0 0;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .chart-card {
        border: 1px solid #702DFF;
        margin-top: 80px;
        background-color: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        color: white;
        margin-bottom: 90px;
    }

    .investor-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .investor-card-header {
        margin-left: 10px;
        color: #6256CA;
        background-color: #fff;
        border-bottom: 5px;
        font-size: 1.7rem;
        font-weight: bold;
        text-align: left;
        margin-bottom: 8px;
    }

    .investor-table th, .investor-table td {
        vertical-align: middle;
    }

    .investor-table th {
        font-weight: normal;
    }

    .investor-table td {
        color: #5F5F5F;
    }

    .investor-btn-link {
        color: #5F5F5F;
        text-decoration: none;
    }

    .investor-btn-link:hover {
        text-decoration: underline;
    }

    .investor-show-all {
        text-align: center;
        padding: 10px 0;
        font-weight: bold;
    }

    .investor-show-all a {
        color: black;
        text-decoration: none;
    }

    .investor-show-all a:hover {
        text-decoration: underline;
    }

    /* Carousel Styles */
    .custom-carousel-container {
        margin-top: 70px;
    }

    .carousel-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Adjusted height for a taller carousel */
    .carousel-card img {
        width: 100%;
        height: 380px; /* Increase height for taller carousel */
        object-fit: cover;
    }

    .carousel-card-body {
        padding: 15px;
        background-color: white;
    }

    .carousel-card-title {
        color: #6256CA;
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .carousel-controls {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #702DFF;
        border-radius: 50%;
        padding: 10px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="profile-header">
        <div class="info">
            <p>INVESTOR</p>
            <h1>{{ Auth::user()->nama_depan }}👋 <i class="fas fa-hand-wave"></i></h1>
        </div>
        <div class="profile-image">
            <img src="images/investorpage/obama.jpg" alt="Profile image of Agraditya Putra smiling, wearing glasses and a white shirt" />
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row stats">
        <div class="col-md-3 col-sm-4">
            <div class="stat">
                <img src="images/investorpage/icon1.svg" alt="Project Icon" />
                <div class="stat-content">
                    <h3>{{ $companyFunded }}</h3>
                    <p>Companies Funded</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="stat">
                <img src="images/investorpage/icon2.svg" alt="Company Icon" />
                <div class="stat-content">
                    <h3>{{ $transactionCount }}</h3>
                    <p>Transactions</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="stat">
                <img src="images/investorpage/icon3.svg" alt="Investment Icon" />
                <div class="stat-content">
                    <h3>Rp{{ number_format($totalInvested) }}</h3>
                    <p>Total Invested</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart and Carousel Side by Side -->
    <div class="row mt-5">
        <!-- Chart Column -->
        <div class="col-md-6">
            <div class="chart-card">
                <h3>Investment Trends</h3>
                <div>{!! $chart2->container() !!}</div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                {!! $chart2->script() !!}
            </div>
        </div>

        <!-- Carousel Column -->
<div class="col-md-6 custom-carousel-container">
    <div id="customCarousel" class="carousel slide custom-carousel" data-bs-ride="carousel">
        <div class="carousel-controls">
            <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#customCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="carousel-inner">
            @foreach ($companies as $index => $company)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="carousel-card">
                        <img src="https://storage.googleapis.com/a1aa/image/xsDrvMl6olZBGd3phCL7krIDHG174HxZSa5oobictMu9s46E.jpg" alt="Company Image {{ $index + 1 }}">
                        <div class="carousel-card-body">
                            <h5 class="carousel-card-title">{{ $company->nama }}</h5>
                            <p>{{ $company->startup_summary }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


    <!-- Tables Below Chart and Carousel -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="investor-card">
                <div class="investor-card-header">Recent Transactions</div>
                <div class="card-body">
                    <table class="investor-table table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Company Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->investment_date->format('d/m/Y') }}</td>
                                <td>{{ $transaction->company->nama }}</td>
                                <td>Rp{{ number_format($transaction->amount) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="investor-show-all">
                    <a href="#">SHOW ALL FUNDING ROUNDS &gt;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="investor-card">
                <div class="investor-card-header">Invested Companies</div>
                <div class="card-body">
                    <table class="investor-table table">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Funding Stage</th>
                                <th>Project Reports</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investedCompanies as $investment)
                            <tr>
                                <td>{{ $investment->company->nama }}</td>
                                <td>{{ $investment->company->funding_stage }}</td>
                                <td><a class="investor-btn-link" href="{{ route('companies.show', $investment->company->id) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="investor-show-all">
                    <a href="#">SHOW ALL FUNDING ROUNDS &gt;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
