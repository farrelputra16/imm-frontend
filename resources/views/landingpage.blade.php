<!DOCTYPE html>
@extends('layouts.app-landingpage')

<style>
    /* Section Hero Styling */
    .section-hero {
        min-height: 10vh;
        display: flex;
        align-items: center;
        padding-top: 80px;
        margin-bottom: 100px;
    }
    /* Adding smooth transition for the changing word */
#changing-word {
    color: #333;
    font-weight: bold;
    display: inline-block;
    transition: opacity 0.5s ease;
}

    /* General container styling with margin for spacing */
    .container {
        margin-top: 1px;
    }

    /* Heading Text Styling */
    .section-hero h1 {
        font-size: 3.5rem;
        line-height: 1.2;
        font-weight: bold;
        color: #333;
    }

    /* Paragraph Text Styling */
    .section-hero p {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* Button Styling */
    .section-hero .btn-success {
        background-color: #86D293;
        border: none;
        padding: 7px 30px;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        color: black;
        transition: all 0.3s ease;
    }

    .section-hero .btn-success i {
        margin-right: 8px;
        color: #FFC107;
    }

    .section-hero .btn-success:hover {
        background-color: #74b583;
        transform: scale(1.05);
    }

    /* Chair Image Animation Styling */
    .chair-image {
        max-height: 800px;
        width: auto;
        animation: float 3s ease-in-out infinite;
    }

    /* Animasi untuk muncul dari sisi kiri */
.animate-left {
    opacity: 0;
    transform: translateX(-100%);
    transition: all 1.0s ease;
}

.animate-left.show {
    opacity: 1;
    transform: translateX(0);
}

/* Animasi untuk muncul dari sisi kanan */
.animate-right {
    opacity: 0;
    transform: translateX(100%);
    transition: all 1.0s ease;
}

.animate-right.show {
    opacity: 1;
    transform: translateX(0);
}

/* Animasi untuk muncul dari atas */
.animate-top {
    opacity: 0;
    transform: translateY(-100%);
    transition: all 1.0s ease;
}

.animate-top.show {
    opacity: 1;
    transform: translateY(0);
}

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-30px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .this-week-section {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .this-week-section h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .this-week-section .row {
        display: flex;
        margin: 0;
    }

    .this-week-section .col-6 {
        width: 50%;
        text-align: center;
        padding: 20px 0;
    }

    .this-week-section .col-6:not(:last-child) {
        border-right: 1px solid #e0e0e0;
    }

    .this-week-section .row:not(:last-child) {
        border-bottom: 1px solid #e0e0e0;
    }

    .this-week-section .number {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .this-week-section .label {
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 768px) {
        .this-week-section {
            width: 90%;
        }
    }
    .fixed-width-table {
        table-layout: fixed;  /* Forces columns to maintain fixed width */
        width: 100%;          /* Ensures the table stretches to the full width */
    }

    .fixed-width-table th,
    .fixed-width-table td {
        width: 33%;           /* Ensures each column gets an equal width */
        text-align: left;      /* Align text to the left for readability */
    }

    .fixed-width-table img {
        width: 30px;          /* Ensuring images have a fixed size */
        height: 30px;
    }
.highlight-title {
    font-size: 1.5rem; /* Perbesar ukuran judul */
    font-weight: bold;
    margin-bottom: 30px;
    color: #000;
}

.custom-card {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%; /* Make sure it stretches to fill its container */
}

.custom-card h3 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0;
    color: #333;
}

.custom-card p {
    font-size: 1rem;
    color: #6c757d;
}

.row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap; /* Ensure the elements wrap if screen size is small */
}

.stats-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    flex: 1 1 80%; /* Perbesar ukuran setiap card ke 30% */
    max-width: 100%; /* Ukuran maksimum setiap card */
    box-sizing: border-box; /* Ensure padding and border are included in width calculation */
    margin-bottom: 20px; /* Space between rows */
}

@media (max-width: 768px) {
    .stats-card {
        flex: 0 0 100%; /* On small screens, each card will take the full width */
        max-width: 100%;
    }
}



    /* Card Hover and Pointer Effects */
    .card-inner {
        border-radius: 20px;
        background-color: #fff;
        width: 80%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer; /* Show pointer */
    }

    /* Hover Effect: Slight lift and shadow */
    .card-inner:hover {
        transform: translateY(-10px);
    }

    .card-inner img {
        max-width: 100%;
        height: auto;
    }

    .card-info {
        color: #5940CB;
        font-size: 1rem;
        margin-top: 15px;
        font-weight: 500;
    }

    /* Styling for making the whole card clickable */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    /* Crunchbase header styling */
    .header-crunchbase {
        margin-top: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-crunchbase h1 {
        font-size: 4.5rem; /* Ukuran font besar */
        color: #6c757d;
        margin-bottom: 0;
        white-space: nowrap; /* Mencegah teks membungkus */
    }

    .header-crunchbase h1 span {
        color: #6256CA;
        white-space: nowrap; /* Mencegah teks membungkus */
    }

    .image-crunchbase {
        max-width: 200px; /* Sesuaikan ukuran gambar */
        width: auto; /* Pastikan gambar responsif */
        height: auto; /* Menjaga rasio aspek gambar */
        margin-left: 20px; /* Tambahkan margin kiri untuk memberi jarak dari teks */
    }

    .col-md-8 {
        flex: 1; /* Mengizinkan kolom teks untuk mengambil ruang yang tersedia */
        max-width: 70%; /* Atur lebar maksimum kolom */
    }

    .col-md-4 {
        flex: 0 0 30%; /* Atur lebar kolom gambar */
        max-width: 30%; /* Atur lebar maksimum kolom */
    }
    .card {
     margin-bottom: 30px; /* Memberikan jarak antar card */
    }


    .news-item {
        display: flex;
        margin-bottom: 40px;
    }

    .news-item img {
        width: 100px;
        height: 100px;
        margin-right: 20px;
        border-radius: 10px;
    }

    .news-item .news-content {
        flex: 1;
    }

    .news-item .news-content h5 {
        font-size: 2rem;
        font-weight: bold;
    }

    .news-item .news-content p {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .news-item .news-content .date {
        font-size: 0.75rem;
        color: #adb5bd;
    }

    .stats-card {
        text-align: center;
        padding: 20px;
    }

    .stats-card h3 {
        font-size: 2rem;
        margin-bottom: 0;
    }
    .promo-card {
    margin-top :40px;
    background-color: #6256CA;
    color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    position: relative; /* To position extra images later */
    margin-bottom:70px;
}

.promo-card p {
    font-size: 0.8rem; /* Adjusted to be larger */
    color: #FFFFFF;
    text-align: left;
}

.promo-card h4 {
    font-size: 1.25rem;
    margin-bottom: 10px;
    color: #FFFFFF;
    text-align: left;
}

.promo-card .btn {
    font-size: 0.6rem;
    background-color: #86D293;
    color: #3F3F46;
    font-weight: bold;
    padding: 5px 15px; /* Adjusted for horizontal alignment */
    white-space: nowrap; /* Ensure text stays on one line */
    text-align: center;

}

.promo-images {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.promo-images img {
    width: 150px;
    height: 150px;
    border-radius: 5px;
    object-fit: cover;
}

/* Extra images outside the promo card */
/* Extra images outside the promo card */
.extra-images {
    position: absolute;
    bottom: -40px; /* Move extra images below the promo card */
    left: 90%;
    transform: translateX(-40%);
    display: flex;
    justify-content: center;
}

.extra-images img {
    width: 100px;
    height: 100px;
    border-radius: 2px;
    object-fit: cover;
    margin-left: -40px; /* Reduce the space between the images */
}



    .table th, .table td {
        vertical-align: middle;
    }

    .table td {
        font-size: 0.875rem;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-item .save-btn {
        color: #6c63ff;
        cursor: pointer;
    }

    .list-group-item .save-btn:hover {
        text-decoration: underline;
    }

    .btn-link {
        color: #6c63ff;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>

@section('content')
<!-- Section Hero -->
<div class="container">
    <div class="row section-hero">
        <!-- Left Side: Text Content -->
        <div class="col-md-6 animate-left">
            <h1>Make Your Decision <br>
                <span id="changing-word">Faster.</span>
            </h1>
            <p>Make better decisions, faster, and more effectively, ensuring success in every aspect of your personal and professional life by focusing on clear goals, strategic planning, and continuous improvement.</p>
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>

        <!-- Right Side: Chair Image -->
        <div class="col-md-6 text-center animate-right">
            <img src="images/landingpage/chairfix.png" class="img-fluid chair-image" alt="Chair with icons">
        </div>
    </div>
</div>

<!-- Section with Cards -->
<div class="container section-cards animate-left">
    <div class="row">
        <!-- First Card -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('companies.list') }}">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix1.png" class="card-img-top" alt="Filters Image">
                </div>
                <p class="card-info">Discover companies with search and AI-powered recommendations</p>
            </a>
        </div>

        <!-- Second Card -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('investors.index') }}">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix2.png" class="card-img-top" alt="Growth Outlook Image">
                </div>
                <p class="card-info">Stay informed with intelligent insights and real-time alerts</p>
            </a>
        </div>

        <!-- Third Card -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('events.index') }}">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix3.png" class="card-img-top" alt="Galax Image">
                </div>
                <p class="card-info">Take action at the right time with personalized workflow tools</p>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>
    </div>
</div>

<!-- Insights Section -->
<div class="container">
    <div class="header-crunchbase animate-right text-start mb-4" style="padding: 0px; margin-right: 0px;">
        <div class="row align-items-center"  style="padding: 0px;  margin-right: 0px;">
            <div class="col-md-8">
                <h1>
                    CRUNCHBASE<br>
                    <span>INSIGHTS & ANALYSIS</span>
                </h1>
            </div>
            <div class="col-md-4 text-end"  style="padding-left: 100px;">

                <img src="images/landingpage/logocrunch.png" class="image-crunchbase" alt="Crunchbase Insights & Analysis Logo">
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Latest Events dan Featured Funding Rounds -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Latest Events
                </div>
                <div class="card-body">
                    <div class="news-item">
                        @foreach ($events as $event)
                        <img alt="Insight image 1" src="" />
                        <div class="news-content">
                            <div class="date">
                                {{ $event->start }}
                            </div>
                            <h5>{{ $event->title }}</h5>
                            <p>{{ $event->topic }}</p>
                            <p>{{ $event->description }}</p>
                        </div>
                    </div>
                        @endforeach
                    <a class="btn-link" href="{{ route('events.index') }}">MORE EVENTS</a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Featured Funding Rounds
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Organization name</th>
                                <th>Investments Amount</th>
                                <th>Departments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investors as $investor)
                            <tr onclick="window.location.href='{{ route('investors.show', $investor->id) }}'">
                                <td>{{ $investor->org_name }}</td>
                                <td>{{ $investor->number_of_investments }}</td>
                                <td>{{ $investor->departments }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn-link" href="{{ route('investors.index') }}">SHOW ALL INVESTORS ></a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: This Week on Crunchbase dan sisanya -->
        <div class="col-md-6">
            <div class="card this-week-section">
                <h1>This Week on Crunchbase</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="number">393</div>
                        <div class="label">FUNDING ROUNDS</div>
                    </div>
                    <div class="col-6">
                        <div class="number">36.7B</div>
                        <div class="label">TOTAL FUNDING</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="number">163</div>
                        <div class="label">ACQUISITIONS RECORDED</div>
                    </div>
                    <div class="col-6">
                        <div class="number">28.2B</div>
                        <div class="label">ACQUISITIONS AMOUNT</div>
                    </div>
                </div>
            </div>

            <div class="promo-card animate-right mt-4">
                <div class="row align-items-center">
                    <!-- Left Side: Text and Button -->
                    <div class="col-md-8">
                        <div class="card-body-promo">
                            <h4>You're missing out</h4>
                            <p>Upgrade to Crunchbase Pro to find and engage with key decision makers</p>
                            <button class="btn">START FREE TRIAL</button>
                        </div>
                    </div>
                    <!-- Right Side: Image -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="promo-images">
                            <img src="images/landingpage/icon-promo.png" alt="Promo Image 1">
                        </div>
                    </div>
                </div>

                <!-- Extra Images Below the Promo Card -->
                <div class="extra-images d-flex justify-content-between">
                    <img src="images/landingpage/bitcoin-promo.png" alt="Extra Image 1">
                    <img src="images/landingpage/bitcoin-promo.png" alt="Extra Image 2">
                </div>
            </div>

            <!-- Featured Searches and Lists Card -->
            <div class="card mt-4">
                <div class="card-header">Featured Searches and Lists</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Government Docs Submitted to UW <span>50</span></li>
                    </ul>
                    <a class="btn-link" href="#">ALL Featured Searches and Lists ></a>
                </div>
            </div>

            <!-- Trending Companies Card -->
            <div class="card mt-4">
                <div class="card-header">Trending Companies</div>
                <div class="card-body">
                    <table class="table fixed-width-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Logo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->nama }}</td>
                                <td><img alt="Company Logo" src="https://placehold.co/30x30" /></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Trending Peoples Card -->
            <div class="card mt-4">
                <div class="card-header">Trending Peoples</div>
                <div class="card-body">
                    <table class="table fixed-width-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                            <tr>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->role }}</td>
                                <td>{{ $person->location }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn-link" href="#">SHOW ALL EVENTS ></a>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    // Function to observe elements
function observeElements() {
    const elements = document.querySelectorAll('.animate-left, .animate-right, .animate-top');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // Stop observing once element is visible
            }
        });
    }, { threshold: 0.1 }); // Trigger when 10% of the element is visible

    elements.forEach(element => {
        observer.observe(element);
    });
}

// Call the function to observe elements when page loads
document.addEventListener('DOMContentLoaded', observeElements);

    // Array of words to rotate
    const words = ['Faster.', 'Better.', 'Effective.','Efficient.'];
    let wordIndex = 0;

    function changeWord() {
      const wordElement = document.getElementById('changing-word');
      wordElement.style.opacity = '0'; // Start fade out

      setTimeout(() => {
        wordElement.textContent = words[wordIndex]; // Change the word
        wordElement.style.opacity = '1'; // Fade in
        wordIndex = (wordIndex + 1) % words.length; // Loop through words
      }, 500); // Wait for fade out transition
    }

    // Change word every 2 seconds
    setInterval(changeWord, 2000);
  </script>

@endsection
</html>
