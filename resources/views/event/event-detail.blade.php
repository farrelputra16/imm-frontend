@extends('layouts.app-landingpage')
@section('title', 'Event Detail')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
    }

    body {
        background-color: white;
    }

    .banner {
        width: 100%; /* Menggunakan 100vw untuk memenuhi lebar viewport */
        height: 500px;
        overflow: hidden; /* Menyembunyikan bagian gambar yang melampaui */
        position: relative; /* Menambahkan posisi relatif untuk elemen anak */
    }

    .banner-img {
        width: 100%; /* Memastikan gambar memenuhi lebar banner */
        height: 100%; /* Memastikan gambar memenuhi tinggi banner */
        object-fit: cover; /* Memastikan gambar terpotong dengan baik */
    }

    .banner-text {
        position: absolute; /* Mengatur posisi absolut untuk menimpa gambar */
        top: 50%; /* Menempatkan teks di tengah vertikal */
        right: 20px; /* Menempatkan teks sedikit dari kanan */
        transform: translateY(-50%); /* Mengatur posisi vertikal agar tepat di tengah */
        color: white; /* Warna teks */
        font-size: 32px; /* Ukuran font */
    }
    .btn{
        background-color: #C1E2A4;
        border : none;
    }
    .header {
        text-align: center;
        margin-top: 20px;
    }

    .header h1 {
        color: #6a0dad;
        font-weight: bold;
    }

    .activities {
        text-align: center;
        margin-top: 40px;
    }

    .activities .icon {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .activities .description {
        font-weight: bold;
    }

    .activities .sub-description {
        color: #555;
    }

    .call-to-action {
        text-align: center;
        margin-top: 40px;
        font-weight: bold;
        font-size: 24px;
    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .text-section {
        flex: 1;
        min-width: 300px;
        text-align: center;
    }

    .image-section {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .image-section img {
        margin: 5px;
    }
    .event-details {
        font-size: 1rem;
        color: #6c757d;
    }
    .event-details i {
        color: #6f42c1;
        margin-right: 5px;
    }
    .event-details .detail-item {
        margin-right: 20px; /* Adjust this value to set the spacing */
    }

    @media (max-width: 768px) {
        .img-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<body>
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('events.index') }}" style="text-decoration: none; color: #212B36;">Event</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="#" style="text-decoration: none; color: #5A5A5A;">Event Detail</a>
                </li>
            </ol>
        </nav>
    </div>
    <section class="banner">
        <img class="banner-img" src="{{ env('APP_URL'). '/' . $event->hero_img }}" alt="Banner Image">
        <div class="banner-text">
            {{ $event->topic }} <!-- Menampilkan topik dari event -->
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <h2>Eventchamps Conference</h2>
        <div class="event-details mt-2">
            <span class="detail-item"><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($event->start)->format('d M Y') }}</span>
            <span class="detail-item"><i class="fas fa-clock"></i> {{ $event->event_duration }}</span>
            <span class="detail-item"><i class="fas fa-map-marker-alt"></i>{{ $event->location }}</span>
            <span class="detail-item"><i class="fas fa-user"></i>{{ $event->allowed_participants }}</span>
            <span class="detail-item"><i class="fas fa-money-bill-wave"></i> {{ $event->fee_type }}</span>
            <span class="detail-item"><i class="fas fa-cogs"></i> Event Organizer by {{ $event->organizer_name }}</span>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <p>{{ $event->description }}</p>
    </div>

    <div class="d-flex justify-content-center">
        @if (in_array(Auth::id(), $eventUsers))
            <button class="btn btn-success mt-4" style="color:#5A5A5A" disabled>Has Been Registered</button>
        @else
            <a href="/event-register/{{ $event->id }}">
                <button class="btn btn-primary mt-4" style="color:#212B36">Daftar Sekarang</button>
            </a>
        @endif
    </div>

    <div class="header">
        <h1>Sustainable Development Activities</h1>
    </div>

    <div class="activities container" style="margin-top: 32px; margin-bottom: 32px;">
        <div class="row">
            <div class="col">
                <div class="icon text-success">
                    <i class="fas fa-tree"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Tree Planting and Reforestation</div>
            </div>
            <div class="col">
                <div class="icon text-danger">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Waste Management and Recycling</div>
            </div>
            <div class="col">
                <div class="icon text-warning">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub -description">Renewable Energy Awareness</div>
            </div>
            <div class="col">
                <div class="icon text-secondary">
                    <i class="fas fa-book"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Education for Sustainable Development</div>
            </div>
            <div class="col">
                <div class="icon text-primary">
                    <i class="fas fa-faucet"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Water Conservation Initiatives</div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-12 text-section">
                <div class="call-to-action">
                    Let’s Take Part In These Activities And Contribute To The Global Movement Towards Sustainability
                </div>
            </div>
            <div class="col-md-12 image-section d-flex justify-content-center">
                <img alt="People participating in a community event" height="100" src="{{ asset('images/gambar1_event.svg')}}" width="200"/>
                <img alt="People installing solar panels" height="100" src="{{ asset('images/gambar_event2.svg') }}" width="200"/>
                <img alt="Community gathering in a rural area" height="100" src="{{ asset('images/gambar_event3.svg') }}" width="200"/>
                <img alt="Person teaching a group of people outdoors" height="100" src="{{ asset('images/gambar_event4.svg') }}" width="200"/>
            </div>
        </div>
    </div>
</body>
@endsection
