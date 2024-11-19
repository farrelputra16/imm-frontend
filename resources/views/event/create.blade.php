@extends('layouts.app-landingpage')

@section('title', 'Event')

@section('css')
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
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h5 {
            font-weight: bold;
        }
        .form-section label {
            font-weight: bold;
        }
        .form-section small {
            font-style: italic;
        }
        /* registration fee */
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 0.25rem;
        }
        .form-select {
            border-radius: 0.25rem;
            height: 40px;
            border: 1px solid #ced4da;
            opacity: 0.5;
            padding-left: 10px;
        }
        .btn-register {
            background-color: #6c63ff;
            color: white;
            font-weight: bold;
            width: 100%;
        }
        .main-content {
            display: flex;
            align-items: center;
            padding: 20px;
            margin-top: 100px;
        }
        .main-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .text-content {
            margin-left: 20px;
        }
        .text-content h1 {
            font-size: 2.5rem;
            color: #4a4a4a;
        }
        .text-content h2 {
            font-size: 2rem;
            color: #4a4a4a;
            font-weight: bold;
        }
        .text-content p {
            font-size: 1rem;
            color: #4a4a4a;
        }

         /* carousel */
         .carousel-item {
            position: relative;
            transition: transform 0.5s ease, opacity 0.5s ease; /* Menambahkan efek transisi opacity */
        }
        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            text-align: left;
        }
        .carousel-caption h5 {
            font-size: 1rem;
            font-weight: bold;
        }
        .carousel-caption p {
            font-size: 0.8rem;
        }
        .carousel-caption .emoji {
            font-size: 1rem;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .carousel-indicators {
            position: static;
            margin-top: 10px;
        }
        .carousel-indicators button {
            background-color: white; /* Warna latar belakang indikator tidak aktif */
            border: 2px solid black; /* Border hitam untuk indikator tidak aktif */
            border-radius: 50%;
            width: 12px;
            height: 12px;
            margin: 0 5px; /* Menambahkan jarak antar indikator */
        }
        .carousel-indicators .active {
            background-color: black; /* Warna untuk indikator aktif */
            border: none; /* Menghilangkan border untuk indikator aktif */
        }
        /* Menghilangkan tombol navigasi */
        .carousel-control-prev,
        .carousel-control-next {
            display: none; /* Sembunyikan tombol navigasi */
        }

        /* Bagian event dan calender */
        .calendar {
            border: 1px solid #d1d1f1;
            border-radius: 10px;
            margin: 20px;
        }
        .calendar th, .calendar td {
            width: 30px;
            height: 30px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #e9ecef;
        }
        .calendar th {
            color: #6c757d;
        }
        .calendar .today {
            background-color: #6256CA;
            border-radius: 50%; /* Lingkaran */
            color: white;
            padding: 5px; /* Tambahkan padding untuk mengurangi ukuran lingkaran */
            width: 30px; /* Ukuran yang lebih kecil */
            height: 30px; /* Ukuran yang lebih kecil */
            display: flex; /* Menjaga konten tetap di tengah */
            justify-content: center; /* Menjaga konten tetap di tengah */
            align-items: center; /* Menjaga konten tetap di tengah */
            margin-top: 10px; /* Pusatkan di dalam sel */
            margin-left: 8px;
        }
        .calendar .text-muted {
            color: #6c757d;
            opacity: 0.5;
        }
        .event-card {
            background-color: #6c63ff;
            color: white;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
        .event-card .badge {
            background-color: #d1d1f1;
            color: #6c63ff;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 10px;
        }
        .event-card .event-title {
            font-size: 16px;
            font-weight: bold;
        }
        .event-card .event-date {
            font-size: 14px;
            color: #e9ecef;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users[]" value="{{ $user->id }}">
            <nav aria-label="breadcrumb" class="mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="#" style="text-decoration: none; color: #5A5A5A;">Event Registration</a>
                    </li>
                </ol>
            </nav>

            <div style="display: flex; justify-content:space-between; align-items: center; margin-bottom: 40px;">
                <h2 id="buatproject" style="color: #6256CA;">Event</h2>
                <h3 style="color: #848484; font-size: 24px;">Event Registration Form</h3>
            </div>

            <div class="form-section">
                <h3>Event Information</h3>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="eventName" class="sub-heading-1">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="title" placeholder="Input your event name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="eventTheme" class="sub-heading-1">Event Theme</label>
                        <input type="text" class="form-control" id="eventTheme" name="topic" placeholder="Input your event theme">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="eventDate" class="sub-heading-1">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="start" placeholder="Input your event date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="eventTime" class="sub-heading-1">Time</label>
                        <input type="text" class="form-control" id="eventTime" name="event_duration" placeholder="Masukkan dalam bentuk 10.00 - 13.00" required>
                        <small class="form-text text-muted">Masukkan waktu dalam format 10.00 - 13.00</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descriptionEvent" class="sub-heading-1">Description Event</label>
                    <textarea class="form-control" id="descriptionEvent" name="description" placeholder="Input your description event" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="eventLocation" class="sub-heading-1">Event Location</label>
                    <input type="text" class="form-control" id="eventLocation" name="location" placeholder="Input your event location" required>
                </div>
                <div class="mb-3">
                    <label for="whoCanAttend" class="sub-heading-1">Who Can Attend <small>(Startup Founders, Entrepreneurs, Technology Professionals, Students, etc.)</small></label>
                    <input type="text" class="form-control" id="whoCanAttend" name="allowed_participants" placeholder="Input who can attend">
                </div>
            </div>

            <div class="form-section">
                <h4 class="mb-4" style="font-weight: bold;">Capacity and Registration Fee</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="expectedNumber" class="form-label sub-heading-1">Expected Number of Participants</label>
                        <input type="number" class="form-control" id="expectedNumber" name="expected_participants" placeholder="Input your expected number" min="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <div style="display: flex; flex-direction: column;">
                            <label for="registrationFee" class="form-label sub-heading-1">Registration Fee</label>
                            <select class="form-select" id="registrationFee" name="fee_type" required>
                                <option selected disabled>select registration fee</option>
                                <option value="Free">Free </option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-section">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="organizerName" class="sub-heading-1">Organizer Name</label>
                        <input type="text" class="form-control" id="organizerName" name="organizer_name" placeholder="Input your organizer name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="sub-heading-1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Input your email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phoneNumber" class="sub-heading-1">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="nomor_tlpn" placeholder="Input your phone number" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h4 class="mb-4" style="font-weight: bold;">Image Upload</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="heroImg" class="sub-heading-1">Hero Image</label>
                        <input type="file" class="form-control" id="heroImg" name="hero_img" required>
                    </div>
                    <div class="col-md-6">
                        <label for="coverImg" class="sub-heading-1">Cover Image</label>
                        <input type="file" class="form-control" id="coverImg" name="cover_img" required>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-register">Register</button>
            </div>
        </form>

        <div class="main-content">
            <img alt="A group of people attending a seminar in a large, open space with white curtains and modern seating." height="400" src="{{ asset('images/image 122.svg') }}" width="600"/>
            <div class="text-content">
                <h2>SDGs Festival:</h 2>
                <h1 style="color: #6256CA">Towards a Sustainable Future</h1>
                <p style="color: #3F3F46; font-size: 16px;">
                    "🌍Join us at the SDGs Festival on November 15 and discover how to contribute to a sustainable future! Enjoy inspiring seminars, creative workshops, and an eco-friendly product bazaar. Let’s invest in our planet together and achieve the SDGs! Free for everyone!"
                </p>
            </div>
        </div>


        <div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
            <div class="carousel-inner">
                @php
                    $eventChunks = $events->chunk(4); // Membagi data event menjadi kelompok 4
                @endphp

                @foreach ($eventChunks as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $event)
                                <div class="col-md-3">
                                    <div class="position-relative">
                                        <img alt="{{ $event->title }}" class="d-block w-100" src="{{ env('APP_URL'). '/' . $event->cover_img }}" />
                                        <div class="carousel-caption d-block">
                                            <h5>{{ $event->title }}</h5>
                                            <h5>{{ $event->topic }}</h5>
                                            <p><span class="emoji">🌍</span> {{ $event->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="carousel-indicators d-flex justify-content-center">
                @foreach ($eventChunks as $index => $chunk)
                    <button aria-label="Slide {{ $index + 1 }}" data-bs-slide-to="{{ $index }}" data-bs-target="#carouselExampleIndicators" type="button" class="{{ $index === 0 ? 'active' : '' }}"></button>
                @endforeach
            </div>
        </div>

        {{-- Bagian untuk calender dan eventnya --}}
        <div class="row align-items-center shadow" style="border-color: #212B36;  border-style: solid; border-width: 1px; padding: 10px; border-radius: 10px; margin-top: 50px;">
            <div class="col-md-4">
                <table class="calendar table table-borderless">
                    <thead>
                        <tr>
                            <th>Su</th>
                            <th>Mo</th>
                            <th>Tu</th>
                            <th>We</th>
                            <th>Th</th>
                            <th>Fr</th>
                            <th>Sa</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body">
                        <!-- Calendar dates will be generated by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                @php
                    // Ambil dua event teratas
                    $twoEvents = $events->take(2);
                @endphp

                @foreach ($twoEvents as $event)
                    <div class="event-card" style="margin-left: 40px; margin-bottom: 50px; height: 120px; padding-left: 26px;">
                        <span class="badge body-1" style="margin-bottom: 10px; color: black; font-size: ">Event</span>
                        <div class="event-title" style="margin-bottom: 10px;">{{ $event->title }}</div>
                        <div class="event-date" style="margin-bottom: 10px;">
                            <i class="fas fa-circle"></i> {{ \Carbon\Carbon::parse($event->start)->format('d F Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Bagian berita --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#carouselExampleIndicators').carousel({
                    interval: 2000,
                    pause: "hover"
                });
            });
        </script>
        <script>
            function generateCalendar() {
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();
                const currentDate = today.getDate();

                const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                const daysInLastMonth = new Date(currentYear, currentMonth, 0).getDate();

                const calendarBody = document.getElementById('calendar-body');
                calendarBody.innerHTML = '';

                let date = 1;
                let lastMonthDate = daysInLastMonth - firstDay + 1;
                let nextMonthDate = 1;

                for (let i = 0; i < 5; i++) {
                    const row = document.createElement('tr');

                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');

                        if (i === 0 && j < firstDay) {
                            // Tanggal dari bulan sebelumnya
                            cell.classList.add('text-muted');
                            cell.innerText = lastMonthDate++;
                        } else if (date > daysInMonth) {
                            // Tanggal dari bulan berikutnya
                            cell.classList.add('text-muted');
                            cell.innerText = nextMonthDate++;
                        } else {
                            // Tanggal aktif
                            cell.innerText = date;
                            if (date === currentDate) {
                                cell.classList.add('today');
                            }
                            date++;
                        }
                        row.appendChild(cell);
                    }
                    calendarBody.appendChild(row);
                }
            }

            document.addEventListener('DOMContentLoaded', generateCalendar);
        </script>
    </div>
@endsection
