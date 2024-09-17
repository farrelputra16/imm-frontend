@extends('layouts.app-investors')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .investor-details {
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

    .investor-description {
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
    <div class="investor-details">
        <h2>{{ $investor->org_name }}</h2>
        <p class="investor-description">{{ $investor->description }}</p>

        <div class="detail-item">
            <span class="highlight">Location:</span> {{ $investor->location }}
        </div>
        <div class="detail-item">
            <span class="highlight">Number of Contacts:</span> {{ $investor->number_of_contacts }}
        </div>
        <div class="detail-item">
            <span class="highlight">Number of Investments:</span> {{ $investor->number_of_investments }}
        </div>
        <div class="detail-item">
            <span class="highlight">Departments:</span> {{ $investor->departments }}
        </div>
    </div>

    <!-- Back button to go back to the list of investors -->
    <a href="{{ route('investors.index') }}" class="back-btn">Back to Investors List</a>
</div>
@endsection
