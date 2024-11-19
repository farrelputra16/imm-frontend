@extends('layouts.app-landingpage')
@section('title', 'Event')
@section('content')
    <style>
        * {
            text-decoration: none;
            list-style-type: none;
        }
        .btn {
            margin-left: 10px;
            gap: 10px;
            /* Adjust margin between login/register buttons */
        }.wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .btn:hover{
            color: white;
        }

        .form-control {
            width: 60%;
        }

        .btn-ungu{
            background-color: #5940cb;
            color:white;
        }

        @media (max-width: 768px) {
                footer {
                    display: none;

                }
                .navbar-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-container input {
            padding: 10px;
            border: 2px solid #5940cb;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }

        .search-container button {
            border: 2px solid #5940cb;
            border-left: none;
            padding: 5px 20px;
            background-color: #5940cb;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            color: #fff;
            font-size: 16px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 364.02px;
            height: 464.24px;
            margin: auto;
            margin-bottom: 20px;
        }
        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-text {
            color: #6c757d;
        }
        .btn-primary {
            background-color: #6f42c1;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #5a32a3;
        }
        .event-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .event-info i {
            color: #6f42c1;
            margin-right: 5px;
        }
        .event-info span {
            margin-right: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .text-center {
            text-align: center;
            margin-top: 19px;
            margin-bottom: 23.24px;
        }

        .pagination-container {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .pagination-container p {
            font-size: 16px;
        }

        .no-events-message {
            text-align: center;
            font-size: 1.2rem;
            color: #999;
            margin-top: 50px;
        }

        /* Tombol untuk pembuatan event */
        .btn-create-event {
            background-color: #6256CA;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(98, 86, 202, 0.3);
            display: inline-block;
            margin-top: 23px;
        }

        .btn-create-event:hover {
            background-color: #5648B3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(98, 86, 202, 0.5);
        }

        .btn-create-event:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(98, 86, 202, 0.5);
        }

        .btn-create-event i {
            margin-right: 10px;
        }
    </style>

    <div class="container">
        <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="#" style="text-decoration: none; color: #212B36;">Events</a>
                </li>
            </ol>
        </nav>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3" style="vertical-align: middle;">
            <h2 class="header-title" style="color: #6256CA">Events</h2>
            @if ($islogin)
                <div style="margin-bottom: 0px; display: flex; justify-content: flex-end;">
                    <a href="{{ route('events.make', ['user_id' => Auth::id()]) }}" class="btn btn-create-event">
                        <i class="fas fa-plus-circle"></i> Buat Event Baru
                    </a>
                </div>
            @endif
        </div>

        <div class="align-items-center">
            <div class="col-md-8">
                <h4 class="mb-0" style="margin-top: 30px">Temukan wawasan tentang dampak baru disini</h4>
            </div>
        </div>
        <div class="search-container mt-4">
            <input type="text" class="form-control" placeholder="Cari disini" id="searchInput">
            <button onclick="searchEvent()" class="btn-search"><i class="fas fa-search"></i></button>
        </div>

        <div class="row mt-5" id="eventContainer">
            <!-- event cards will be inserted here by JavaScript -->
        </div>

        <div id="noEventsMessage" class="no-events-message py-3 border" style="display: none;">
            Belum ada acara.
        </div>
        <div class="pagination-container">
            <button id="prevPageBtn" class="btn btn-secondary mr-2" disabled>Sebelumnya</button>
            <button id="nextPageBtn" class="btn btn-ungu">Berikutnya</button>
            <p class="ml-2 mt-3">Halaman <span id="currentPage">1</span> dari <span id="totalPages"></span></p>
        </div>
    </div>

    <script>
        const Url = @json($Url);
        const events = @json($events);

        document.addEventListener("DOMContentLoaded", function() {
            const eventContainer = document.getElementById("eventContainer");
            const noEventsMessage = document.getElementById("noEventsMessage");
            const eventsPerPage = 6;
            const totalPages = Math.ceil(events.length / eventsPerPage);
            let currentPage = 1;

            function showEvents(page) {
                const startIndex = (page - 1) * eventsPerPage;
                const endIndex = startIndex + eventsPerPage;
                const currentEvents = events.slice(startIndex, endIndex);

                eventContainer.innerHTML = '';

                currentEvents.forEach((event) => {
                    const eventCard = document.createElement("div");
                    eventCard.className = "card";
                    console.log(event.cover_img);
                    eventCard.innerHTML = `
                        <img src="${event.cover_img}" alt="${event.title}" class="card-img-top">
                        <div class="card-body">
                            <div>
                                <h5 class="card-title">${event.title}</h5>
                                <div class="event-info">
                                    <div>
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>${event.start}</span>
                                    </div>
                                    <div style="margin-left: 30px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>${event.location}</span>
                                    </div>
                                </div>
                                <p class="card-text">${event.description}</p>
                            </div>
                            <div class="text-center">
                                <a href="/event/${event.id}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    `;
                    eventContainer.appendChild(eventCard);
                });

                if (currentEvents.length === 0) {
                    noEventsMessage.style.display = "block";
                } else {
                    noEventsMessage.style.display = "none";
                }

                document.getElementById("currentPage").textContent = page;
                currentPage = page;
                updatePaginationButtons();
            }

            // Call showEvents for the first page
            showEvents(currentPage);

            function updatePaginationButtons() {
                const totalPages = Math.ceil(events.length / eventsPerPage);
                document.getElementById("totalPages").textContent = totalPages;

                if (currentPage > 1) {
                    document.getElementById("prevPageBtn").disabled = false;
                } else {
                    document.getElementById("prevPageBtn").disabled = true;
                }

                if (currentPage < totalPages) {
                    document.getElementById("nextPageBtn").disabled = false;
                } else {
                    document.getElementById("nextPageBtn").disabled = true;
                }
            }

            showEvents(1);

            document.getElementById("nextPageBtn").addEventListener("click", function() {
                if (currentPage < totalPages) {
                    showEvents(currentPage + 1);
                }
            });

            document.getElementById("prevPageBtn").addEventListener("click", function() {
                if (currentPage > 1) {
                    showEvents(currentPage - 1);
                }
            });

            document.getElementById("searchInput").addEventListener("input", searchEvent);
        });

        function searchEvent() {
            const input = document.getElementById("searchInput").value.trim().toLowerCase();
            const eventCards = document.querySelectorAll(".event-card");
            const noEventsMessage = document.getElementById("noEventsMessage");
            let found = false;

            eventCards.forEach ((card) => {
                const title = card.querySelector("h3").textContent.toLowerCase();
                const content = card.querySelector("p").textContent.toLowerCase();
                if (title.includes(input) || content.includes(input)) {
                    card.style.display = "block";
                    found = true;
                } else {
                    card.style.display = "none";
                }
            });

            if (found) {
                noEventsMessage.style.display = "none";
            } else {
                noEventsMessage.style.display = "block";
            }
        }
    </script>
@endsection
