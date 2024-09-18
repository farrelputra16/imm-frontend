@extends('layouts.app-table')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .people-details {
        background-color: #f7f7f7;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    h2 {
        color: #5940CB;
        font-weight: 600;
        font-size: 2rem;
    }

    .people-description {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 20px;
    }

    .detail-item {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .highlight {
        font-weight: bold;
        color: #5940CB;
    }

    .back-btn {
        background-color: #ff9f0a;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        font-size: 1rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .back-btn:hover {
        background-color: #ff7a00;
    }

    .linkedin-link {
        display: inline-block;
        margin-top: 15px;
    }

    .linkedin-icon {
        width: 32px;
        height: 32px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .linkedin-text {
        vertical-align: middle;
        color: #0077b5;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .linkedin-text:hover {
        color: #005582;
    }
</style>

<div class="container">
    <div class="people-details">
        <h2>{{ $people->primary_job_title }}</h2>
        <p class="people-description">{{ $people->description }}</p>

        <div class="detail-item">
            <span class="highlight">Name:</span> {{ ucfirst($people->name) }}
        </div>
        <div class="detail-item">
            <span class="highlight">Role:</span> {{ ucfirst($people->role) }}
        </div>
        <div class="detail-item">
            <span class="highlight">Primary Organization:</span> {{ $people->primary_organization }}
        </div>
        <div class="detail-item">
            <span class="highlight">Location:</span> {{ $people->location }}
        </div>
        <div class="detail-item">
            <span class="highlight">Phone Number:</span> {{ $people->phone_number }}
        </div>
        <div class="detail-item">
            <span class="highlight">Gmail:</span> {{ $people->gmail }}
        </div>

        <!-- LinkedIn Link -->
        @if ($people->linkedin_link)
            <div class="linkedin-link">
                <a href="{{ $people->linkedin_link }}" target="_blank" class="linkedin-text">
                    <img src="/images/linkedin.png" alt="LinkedIn" class="linkedin-icon">
                    Visit
                </a>
            </div>
        @endif
    </div>

    <!-- Back button to go back to the list of people -->
    <a href="{{ route('people.index') }}" class="back-btn">Back to People List</a>
</div>
@endsection
