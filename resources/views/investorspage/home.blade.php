@extends('layouts.app-investors')
@section('title', 'Halaman IMM')

@section('css')
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .profile-card {
        margin-top: 150px;
        background-color: #e0e7ff;
        border-radius: 15px;
        padding: 70px;
        display: flex;
        align-items: center;
        margin-bottom: 70px;
        position: relative;
    }
    .profile-card img {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        margin-right: 20px;
    }
    .profile-card .name {
        font-size: 24px;
        font-weight: bold;
        color: #6256CA;
    }
    .profile-card .role {
        font-size: 16px;
        color: #6256CA;
    }
    .profile-card .right-image {
        position: absolute;
        right: -18px;
        top: 0;
        height: 100%;
        border-radius: 0 15px 15px 0;
        overflow: hidden;
    }
    .profile-card .right-image img {
        height: 100%;
        width: auto;
        object-fit: cover;
        border-radius: 0 15px 15px 0;
    }
    .image-card {
        margin-bottom: 70px;
    }
    .image-card .position-relative {
        margin-right: 15px;
        margin-left: 15px;
    }
    @media (max-width: 768px) {
        .image-card .position-relative {
            margin-right: 0;
            margin-left: 0;
        }
    }
    .chart-card {
        background-color: #2d2d6d;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        color: white;
        margin-bottom: 90px;
    }
    .chart-card img {
        width: 100%;
        border-radius: 10px;
    }
    .investor-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .investor-card-header {
        background-color: #fff;
        border-bottom: 5px;
        font-size: 1.3rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 8px;
    }
    .investor-table th, .investor-table td {
        vertical-align: middle;
    }
    .investor-table th {
        font-weight: bold;
    }
    .investor-btn-link {
        color: #007bff;
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
        color: #007bff;
        text-decoration: none;
    }
    .investor-show-all a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="profile-card d-flex">
        <img alt="Profile picture" height="80" src="images/investorpage/obama.jpg" width="80"/>
        <div>
            <div class="name">{{ Auth::user()->nama_depan }}</div>
            <div class="role">Investor</div>
        </div>
        <div class="right-image">
            <img src="images/landingpage/investorpage.jpeg" alt="Profile background image">
        </div>
    </div>

    <div class="row image-card">
        <div class="col-md-4">
            <div class="position-relative">
                <img src="{{ asset('images/investorpage/card1.png') }}" alt="Card 1" class="img-fluid" />
                <div class="position-absolute top-50 start-50 translate-middle text-white">
                    <h3>{{ $companyFunded }}</h3>
                    <p>Companies Funded</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative">
                <img src="{{ asset('images/investorpage/card2.png') }}" alt="Card 2" class="img-fluid" />
                <div class="position-absolute top-50 start-50 translate-middle text-white">
                    <h3>{{ $transactionCount }}</h3>
                    <p>Transactions</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative">
                <img src="{{ asset('images/investorpage/card3.png') }}" alt="Card 3" class="img-fluid" />
                <div class="position-absolute top-50 start-50 translate-middle text-white">
                    <h3>Rp{{ number_format($totalInvested) }}</h3>
                    <p>Total Invested</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="chart-card">
                <h3>Investment Trends</h3>
                <div>{!! $chart2->container() !!}</div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                {!! $chart2->script() !!}
            </div>
        </div>
    </div>

    <div class="row">
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
@endsection
