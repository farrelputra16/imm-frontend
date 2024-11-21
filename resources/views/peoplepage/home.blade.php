@extends('layouts.app-people')

@section('title', 'Halaman IMM')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: white;
            font-family: 'Arial', sans-serif;
        }
        .service-offers {
            margin-top: 80px;
            background-color: white;
            padding: 50px 0;
        }
        .service-offers-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
        }
        .service-offers-text {
            color: #333;
            max-width: 50%;
        }
        .service-offers-title-1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .service-offers-title-2 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .text-black-custom {
            color: #333 !important;
        }
        .text-purple-custom {
            color: #5a4fcf !important;
            font-style: italic; /* Menerapkan gaya miring pada teks berwarna ungu */
        }
        .service-offers-description {
            color: #666;
            font-size: 1rem;
        }
        .service-offers img {
            max-width: 100%;
            border-radius: 10px;
        }
        .collaboration, .upcoming-events {
            padding: 50px 0;
        }
        .collaboration-title, .upcoming-events-title {
            color: #5a4fcf;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .custom-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .custom-card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .custom-card-text {
            color: #666;
        }
        .custom-btn {
            background-color: #5a4fcf;
            color: #fff;
            border-radius: 25px;
            padding: 5px 15px;
        }
        .upcoming-event-card {
            display: flex;
            margin-bottom: 20px;
        }
        .upcoming-event-card img {
            border-radius: 10px;
            width: 100%;
            height: auto;
        }
        .event-details {
            padding: 20px;
        }
        .event-details-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .event-details-text {
            color: #666;
        }
    </style>
@endsection

@section('content')
<div class="service-offers">
    <div class="container">
        <div class="row service-offers-content">
            <div class="col-md-6 service-offers-text">
                <h1 class="service-offers-title-1">
                    <span class="text-black-custom">Powerful</span>
                    <span class="text-purple-custom">Collaboration,</span>
                </h1>
                <h2 class="service-offers-title-2">
                    <span class="text-black-custom">Unforgettable</span>
                    <span class="text-purple-custom">Events!</span>
                </h2>
                <p class="service-offers-description">With us, your ideas come to life! From concept to execution, we’re here to create remarkable moments.</p>
            </div>
            <div class="col-md-6">
                <img src="images/peoplepage/gambar1.png" alt="Service Offer Image">
            </div>
        </div>
    </div>
</div>

<div class="collaboration">
    <h2 class="collaboration-title">Collaboration</h2>
    <div class="container">
        <div class="row">
            @foreach($collaborations as $collaboration)
            <div class="col-md-4 mb-4">
                <div class="card custom-card">
                    <img src="{{ $collaboration->image }}" class="card-img-top" alt="{{ $collaboration->title }}" height="400" width="600">
                    <div class="card-body">
                        <h5 class="custom-card-title">{{ $collaboration->title }}</h5>
                        <p class="custom-card-text">{{ $collaboration->description }}</p>
                        <a href="{{ route('collaboration.applicant.create') }}" class="btn custom-btn">Collaborate</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="upcoming-events">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="upcoming-events-title">Upcoming Events</h2>
            <button class="btn custom-btn">See All</button>
        </div>
        <div class="row">
            <!-- Event pertama dengan layout utama -->
            @if($upcomingEvents->isNotEmpty())
                <div class="col-md-8 mb-4">
                    <div class="card upcoming-event-card">
                        <img src="https://storage.googleapis.com/a1aa/image/fbT2Y7EkJt1DSao2pD7fsrUMWeM92zc1D41kNzOv8MrSxf1OB.jpg" alt="{{ $upcomingEvents[0]->title }}" height="400" width="600">
                        <div class="event-details">
                            <h5 class="event-details-title">{{ $upcomingEvents[0]->title }}</h5>
                            <p><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($upcomingEvents[0]->start)->format('d F Y') }} <i class="fas fa-map-marker-alt"></i> {{ $upcomingEvents[0]->location }}</p>
                            <p class="event-details-text">{{ Str::limit($upcomingEvents[0]->description, 100) }}</p>
                            <button class="btn custom-btn">View Details</button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Event selanjutnya dengan layout card kecil -->
            <div class="col-md-4">
                @foreach($upcomingEvents->skip(1) as $event)
                    <div class="card upcoming-event-card mb-4">
                        <img src="https://storage.googleapis.com/a1aa/image/9umlmk6uZWqDIxb1Nel9qo72lLGJV52QHe8ySycStyZy4fanA.jpg" alt="{{ $event->title }}" height="400" width="600">
                        <div class="event-details">
                            <h5 class="event-details-title">{{ $event->title }}</h5>
                            <p class="event-details-text">{{ Str::limit($event->description, 50) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
