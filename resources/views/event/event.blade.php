@extends('layouts.app-landingpage')
@section('title', 'Event')
    <style>
        * {
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            list-style-type: none;
        }
        body,
        html {
            font-family: "Roboto", sans-serif;
            height: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
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

        .event-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            min-height: 400px;
            text-align: left;
            flex: 0 0 30%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk efek elevasi */
            border: 1px solid #ddd; /* Menambahkan border untuk membuat tampilan lebih modern */
        }

        .event-card a {
            text-decoration: none;
            color: inherit;
        }

        .event-card .event-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            margin-bottom: 20px;
            border-radius: 10px;
            object-fit: cover; /* Menambahkan object-fit untuk membuat gambar lebih rapih */
        }

        .event-card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            min-height: 3em;
        }

        .event-card p {
            font-size: 1.1rem;
            line-height: 1.5;
            flex-grow: 1;
            margin-bottom: 15px; /* Jarak bawah antara paragraf dan judul */
            color: #666; /* Menambahkan warna untuk membuat teks lebih jelas */
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Menambahkan efek hover untuk membuat tampilan lebih modern */
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
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(98, 86, 202, 0.3);
            display: inline-block;
            margin-top: 20px;
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

@section('content')
    <div class="container mt-5">
        @if ($islogin)
            <div style="margin-bottom: 0px; display: flex; justify-content: flex-end;">
                <a href="{{ route('events.make', ['user_id' => Auth::id()]) }}" class="btn btn-create-event">
                    <i class="fas fa-plus-circle"></i> Buat Event Baru
                </a>
            </div>
        @endif
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
        const backendUrl = @json($backendUrl);
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
                    eventCard.className = "event-card";
                    eventCard.innerHTML = `
                        <a href="/event/${event.id}" class="text-left">
                            <div class="event-image" style="background-image: url(${event.cover_img});"></div>
                            <div class="event-info">
                                <h3>${event.title}</h3>
                                <p>${event.description}</p>
                                <div class="event-details">
                                    <div class="detail">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Location: ${event.location}</span>
                                    </div>
                                    <div class="detail">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Start Date: ${event.start}</span>
                                    </div>
                                    <div class="detail">
                                        <i class="fas fa-clock"></i>
                                        <span>Event Duration: ${event.event_duration}</span>
                                    </div>
                                    <div class="detail">
                                        <i class="fas fa-users"></i>
                                        <span>Allowed Participants: ${event.allowed_participants}</span>
                                    </div>
                                    <div class="detail">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span>Fee Type: ${event.fee_type}</span>
                                    </div>
                                </div>
                                <div class="event-organizer">
                                    <h4>Organizer</h4>
                                    <p>${event.organizer_name}</p>
                                    <p>${event.email}</p>
                                    <p>${event.nomor_tlpn}</p>
                                </div>
                            </div>
                        </a>
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
