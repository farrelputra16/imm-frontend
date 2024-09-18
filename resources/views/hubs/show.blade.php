@extends('layouts.app-table')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hub-details {
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

    .hub-description {
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
</style>

<div class="container">
    <div class="hub-details">
        <h2>{{ $hub->name }}</h2>
        <p class="hub-description">{{ $hub->description }}</p>

        <div class="detail-item">
            <span class="highlight">Location:</span> {{ $hub->location }}
        </div>
        <div class="detail-item">
            <span class="highlight">Number of Organizations:</span> {{ $hub->number_of_organizations }}
        </div>
        <div class="detail-item">
            <span class="highlight">Number of People:</span> {{ $hub->number_of_people }}
        </div>
        <div class="detail-item">
            <span class="highlight">Number of Events:</span> {{ $hub->number_of_events }}
        </div>
        <div class="detail-item">
            <span class="highlight">Rank:</span> {{ $hub->rank }}
        </div>
    </div>

    <!-- Back button to go back to the list of hubs -->
    <a href="{{ route('hubs.index') }}" class="back-btn">Back to Hubs List</a>
</div>
@endsection
