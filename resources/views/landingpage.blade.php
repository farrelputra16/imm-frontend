@extends('layouts.app-landingpage')

@push('styles')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: white;
        overflow-x: hidden;
    }

    /* Floating objects */
    .floating-object {
        position: fixed;
        border-radius: 50%;
        opacity: 0.25;
        animation: float 15s ease-in-out infinite, moveAcross 20s linear infinite;
        z-index: 0;
    }

    .floating-object-1 { width: 200px; height: 200px; background-color: rgba(255, 159, 10, 0.3); top: 10%; left: 15%; }
    .floating-object-2 { width: 300px; height: 300px; background-color: #5940CB; top: 35%; right: 5%; }
    .floating-object-3 { width: 150px; height: 150px; background-color: #5940CB; bottom: 10%; left: 20%; }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-30px); }
        100% { transform: translateY(0); }
    }

    @keyframes moveAcross {
        0% { transform: translateX(0); }
        100% { transform: translateX(100px); }
    }

    /* Hero Section with Two Columns */
    .hero-section, .reverse-section {
        padding: 60px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hero-content {
        flex: 1;
        max-width: 50%;
        text-align: left;
    }

    .reverse-content {
        flex: 1;
        max-width: 50%;
        text-align: right; /* Align text to the right */
        margin-left: auto; /* Push content to the right */
    }

    .hero-content h1, .reverse-content h1 {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(90deg, #5940CB, black);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-content p, .reverse-content p {
        font-size: 1.2rem;
        margin: 20px 0;
    }

    .btn-cta,
    .cta-button {
        background-color: #5940CB;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 1.1rem;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 20px;
        text-decoration: none; /* Remove underline */
    }

    .btn-cta:hover,
    .cta-button:hover {
        background-color: #4829a0;
        transform: scale(1.05);
    }

    /* GIF Alignment */
    .hero-gif, .reverse-gif {
        flex: 1;
        max-width: 50%;
    }
    .hero-gif{
        text-align: right;
    }

    .reverse-gif {
        margin-right: auto; /* Push GIF to the left */
        text-align: left; /* Align content to the left */
    }

    .hero-gif img, .reverse-gif img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    /* Call-to-action Section */
    .cta-section {
        padding: 60px 20px;
        background-color: #f0f4ff;
        text-align: center;
        margin-top: 40px;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        color: #5940CB;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .cta-section h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #000;
        margin-bottom: 20px;
    }

    .cta-section p {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 30px;
    }

    /* Grid for the 3 tables */
    .grid-tables {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
        grid-gap: 20px;
        margin: 50px 0;
    }

    .grid-tables > div {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #5940CB;
    }

    /* Adjust layout for mobile */
    @media (max-width: 768px) {
        .grid-tables {
            grid-template-columns: 1fr;
        }

        .reverse-content {
            text-align: center; /* Align text center on mobile */
        }

        .reverse-gif {
            text-align: center; /* Center GIF on mobile */
        }
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #5940CB;
        color: white;
    }
</style>
@endpush

@section('content')
    <!-- Floating Objects -->
    <div class="floating-object floating-object-1"></div>
    <div class="floating-object floating-object-2"></div>
    <div class="floating-object floating-object-3"></div>

    <!-- Main Hero Section with Two Columns -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Empowering Innovation, Measuring Impact</h1>
            <p>Captures the essence of empowering companies with innovation while providing measurable results.</p>
            <button class="btn-cta">Explore</button>
        </div>

        <div class="hero-gif">
            <img src="images/innovation.jpeg" alt="GIF showcasing innovation">
        </div>
    </div>

    <!-- Call-to-action Section -->
    <div class="cta-section">
        <h2>Manage and Measure</h2>
        <h3>Your Project</h3>
        <p>See your impact on SDGS and manage your project.</p>
        <a href="{{ route('home') }}" class="cta-button">Try IMM</a>
    </div>

    <!-- New Reverse Section with Text on the Right and GIF on the Left -->
    <div class="reverse-section">
        <div class="reverse-gif">
            <img src="images/investor.jpeg" alt="GIF showcasing technology">
        </div>

        <div class="reverse-content">
            <h1>Find an Investor!</h1>
            <p>Need Fund for your Project? Search for an Investor.</p>
            <button class="btn-cta">Discover More</button>
        </div>
    </div>

    <!-- Grid Section for the 3 Tables -->
    <div class="grid-tables">
        <!-- Companies List -->
        <div>
            <h3>Top Companies</h3>
            <table>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Industry</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Company A</td>
                        <td>Technology</td>
                    </tr>
                    <tr>
                        <td>Company B</td>
                        <td>Healthcare</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Investors List -->
        <div>
            <h3>Top Investors</h3>
            <table>
                <thead>
                    <tr>
                        <th>Investor</th>
                        <th>Industry Focus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Investor X</td>
                        <td>Finance</td>
                    </tr>
                    <tr>
                        <td>Investor Y</td>
                        <td>Technology</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Events List -->
        <div>
            <h3>Upcoming Events</h3>
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Event 1</td>
                        <td>12/12/2024</td>
                    </tr>
                    <tr>
                        <td>Event 2</td>
                        <td>01/01/2025</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
