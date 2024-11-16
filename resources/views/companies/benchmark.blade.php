@extends('layouts.app-landingpage')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    .breadcrumb {
        background-color: white;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }
    .header-title {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #6256CA;
        font-size: 2.5rem;
        font-weight: bold;
    }
    /* Bagian Company */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .card img {
        border-radius: 10px;
    }
    .card-title {
        font-weight: bold;
        margin-bottom: 0px;
    }
    .card-subtitle {
        color: #28a745;
        font-size: 1.25rem;
    }
    .card-text {
        margin-top: 2.0625rem; /* 33px in rem */
    }
    .contact-info {
        color: #6c757d;
        font-size: 1rem;
    }
    .align-items-center-profile {
        align-items: flex-start !important;
    }
    .additional-info {
        margin-top: 1rem;
        max-width: 60%;
    }
    .info-box {
        border: 1px solid #d3d3d3;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 15px;
        text-align: start;
        margin: 5% auto;
        border-radius: 2px;
        gap: 10px;
        transition: all 0.3s ease;
    }
    .funding-title {
        color: #7d7d7d;
    }
    .funding-amount {
        color: #333333;
    }
    .custom-icon-color {
        color: #6f42c1 !important;
        font-size: 1rem;
    }
    .info-box:hover {
        background-color: #f1f1f1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .row .col-md-4 {
        padding-right: 5px;
        padding-left: 5px;
    }

</style>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('companies.list', ['status' => 'benchmark']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #5A5A5A;" aria-current="page">Company Profile</li>
        </ol>
    </nav>

    <div>
        <h2 style="color: #6256CA;">Company Profile</h2>
    </div>

    <div style="padding: 0px; margin-top: 32px;">
        <div class="row align-items-center-profile">
            <div class="col-md-3">
                <img
                    alt="Lion Bird logo with a lion's face and bird's body"
                    class="img-fluid"
                    height="200"
                    src="{{ env('APP_URL') . $company->image ? env('APP_URL') . $company->image : asset('images/1720765715.webp') }}"
                    width="200"
                />
            </div>
            <div class="col-md-9">
                <h2 class="card-title">{{ $company->nama }}</h2>
                <h2 class="card-subtitle mb-2">{{ $company->business_model }}</h2>
            </div>
        </div>
    </div>
    {{-- <p class="card-text">
        {{ $company->startup_summary }}
    </p> --}}
    <div class="additional-info" style="margin-top: 16px;">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Total Funding</div>
                    <div class="funding-amount">
                        <h4>
                            <?php
                                $formatted_amount = '';

                                if ($total_funding >= 1000000) {
                                    $formatted_amount = number_format($total_funding / 1000000, 2, ',', '.') . 'M'; // M untuk million
                                } elseif ($total_funding >= 1000) {
                                    $formatted_amount = number_format($total_funding / 1000, 2, ',', '.') . 'K'; // K untuk thousand
                                } else {
                                    $formatted_amount = number_format($total_funding, 0, ',', '.');
                                }

                                // Menambahkan simbol dollar
                                $formatted_amount = '$' . $formatted_amount;

                                echo $formatted_amount;
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Location</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $company->negara }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Last Funding</div>
                    <div class="funding-amount">
                        <h4>
                            <?php
                                $formatted_amount = '';

                                if ($funding_terbaru->money_raised >= 1000000) {
                                    $formatted_amount = number_format($funding_terbaru->money_raised / 1000000, 2, ',', '.') . 'M'; // M untuk million
                                } elseif ($funding_terbaru->money_raised >= 1000) {
                                    $formatted_amount = number_format($funding_terbaru->money_raised / 1000, 2, ',', '.') . 'K'; // K untuk thousand
                                } else {
                                    $formatted_amount = number_format($funding_terbaru->money_raised, 0, ',', '.');
                                }

                                // Menambahkan simbol dollar
                                $formatted_amount = '$' . $formatted_amount;

                                echo $formatted_amount;
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Funding Stage</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $company->funding_stage }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Total Rounds</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $total_round }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Investors</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $total_investor }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <hr style="margin-top: 32px; margin-bottom: 32px; border-top: 2px solid #000000;">
    </div>
    <div>
        <h2 style="color: #6256CA;">{{ $company->nama }} Overview</h2>
    </div>
    <div style="margin-top: 24px;">
        {{ $company->startup_summary }}
    </div>
    <div class="row">
        {{-- Graph finance --}}
        <div class="col-md-6">
        </div>
        {{-- Graph Invesment --}}
        <div class="col-md-6">
        </div>
    </div>
</div>
@endsection
