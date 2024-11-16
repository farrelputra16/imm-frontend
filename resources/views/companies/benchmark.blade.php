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
        display: flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 2px;
        padding: 15px;
        gap: 10px;
        margin-bottom: 10px;
        height: 80px;
        width: 100%;
        max-width: 200px;
        transition: all 0.3s ease;
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
                    <i class="fas fa-phone-alt custom-icon-color"></i>
                    <span>{{ $company->telepon }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-map-marker-alt custom-icon-color"></i>
                    <span>{{ $company->negara }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <a href="{{ $company->profile }}" target="_blank" title="{{ $company->profile }}" style="color: black; text-decoration: none;">
                    <div class="info-box">
                        <i class="fas fa-globe custom-icon-color"></i>
                        <span id="company-profile">{{ Str::limit($company->profile, 18, '...') }}</span>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-users custom-icon-color"></i>
                    <span>{{ $company->jumlah_karyawan }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="fas fa-dollar-sign custom-icon-color"></i>
                    <span id="funding-stage">{{ $company->funding_stage }}</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
