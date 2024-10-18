@extends('layouts.app-landingpage')

<!-- Styles -->
<style>
    .btn-invest {
        background-color: #6256CA;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .btn-invest:hover {
        background-color: #4e44a8;
        color: white;
    }
    /* Styling specific for the table-investor class */
    .table-investor {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1rem;
        text-align: left;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-investor thead th {
        background-color: #6256CA;
        color: white;
        padding: 12px;
        font-weight: bold;
    }

    .table-investor tbody td {
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #fff;
    }

    .table-investor tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-investor a {
        color: #6256CA;
        text-decoration: none;
        font-weight: bold;
    }

    .table-investor a:hover {
        text-decoration: underline;
    }

    .table-investor tbody td:nth-child(2) {
        text-align: right;
    }
</style>

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('people.index') }}">
                    Funding Rounds
                </a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">
                Funding Details
            </li>
        </ol>
    </nav>

    <h1 class="mentor-profile-title">
        Funding Round Details
    </h1>

    <div class="profile-card p-4 bg-white">
        <div class="row">
            <div class="col-md-2">
                <img alt="Company Logo" class="img-profile" height="100" src="https://storage.googleapis.com/a1aa/image/fyw9SmXxl0xeDEL8arxfQGnTTeSkf2JUwLRrYRLWQ7lVXPicC.jpg" width="100"/>
            </div>
            <div class="col-md-10">
                <div class="name">
                    {{ $fundingRound->name }}
                </div>
                <div class="contact-info mt-3">
                    <p>
                        <i class="fas fa-building"></i>
                        {{ $fundingRound->company->nama }}
                    </p>
                    <p>
                        Target: Rp {{ number_format($fundingRound->target, 0, ',', '.') }}<br>
                        Raised: Rp {{ number_format($fundingRound->money_raised, 0, ',', '.') }}<br>
                        Lead Investor:
                        @if ($fundingRound->leadInvestor)
                            <a href="{{ route('investors.show', $fundingRound->leadInvestor->id) }}">
                                {{ $fundingRound->leadInvestor->org_name }}
                            </a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan tombol di sini -->
    <div class="d-flex justify-content-between align-items-center mt-5">
        <a href="{{ route('investments.createFromFundingRound', $fundingRound->id) }}" class="btn-invest">Start Invest</a>
    </div>
    <!-- Investors Table with unique styling -->
    <div class="table-container mt-5">
        <h2>Investors</h2>
        <table class="table-investor">
            <thead>
                <tr>
                    <th>Investor Name</th>
                    <th>Amount Invested</th>
                    <th>Investment Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                <tr>
                    <td>
                        <a href="{{ route('investors.show', $investment->investor->id) }}">
                            {{ $investment->investor->org_name }}
                        </a>
                    </td>
                    <td>Rp {{ number_format($investment->amount, 0, ',', '.') }}</td>
                    <td>{{ $investment->tipe_investasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
