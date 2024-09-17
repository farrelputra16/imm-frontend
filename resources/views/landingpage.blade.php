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

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-30px); }
        100% { transform: translateY(0); }
    }

    @keyframes moveAcross {
        0% { transform: translateX(0); }
        100% { transform: translateX(100px); }
    }

    /* Keyframes for GIF Animation */
    @keyframes gifBounce {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px); /* Move up */
        }
        100% {
            transform: translateY(0); /* Move back down */
        }
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
        text-align: right;
        margin-left: auto;
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

    .btn-cta, .cta-button {
        background-color: #5940CB;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 1.1rem;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 20px;
        text-decoration: none;
    }

    .btn-cta:hover, .cta-button:hover {
        background-color: #4829a0;
        transform: scale(1.05);
    }

    /* GIF Alignment */
    .hero-gif, .reverse-gif {
        flex: 1;
        max-width: 50%;
        animation: gifBounce 3s ease-in-out infinite; /* Apply the bounce animation */
    }

    .hero-gif img, .reverse-gif img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .hero-gif{
        text-align: right;
    }

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

    /* Grid for the table */
    .grid-tables {
        display: flex;
        justify-content: space-evenly; /* Align tables side by side */
        margin: 50px auto;
        max-width: 80%; /* Set a max width for the container */
    }

    .grid-tables > div {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #5940CB;
        max-width: 40%; /* Set the table width to 40% */
        width: 100%;
        overflow: hidden; /* Ensure content doesn't overflow */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        transition: transform 0.3s ease;
        table-layout: fixed; /* Fixed layout ensures table stays within the container */
        word-wrap: break-word; /* Ensure long words break and stay within the table */
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 10px;
    }

    th {
        background-color: transparent;
        color: black;
    }

    /* Center the "Top Investors" and "Top Companies" titles inside the tables */
    .grid-tables h3 {
        text-align: center;
        margin-bottom: 15px;
        font-size: 16px;
    }

    /* Hover effect for expanding */
    table:hover {
        transform: scale(1.05);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .hero-section, .reverse-section {
            flex-direction: column;
            text-align: center;
        }

        .grid-tables {
            flex-direction: column;
            justify-content: center; /* Center the table on small screens */
        }

        .grid-tables > div {
            margin-bottom: 20px;
            max-width: 100%;
        }

        th, td {
            font-size: 10px; /* Make the font smaller for small screens */
        }
    }
</style>
@endpush

@section('content')
    <div class="hero-section">
        <div class="hero-content">
            <h1>Empowering Innovation, Measuring Impact</h1>
            <p>Captures the essence of empowering companies with innovation while providing measurable results.</p>
            <button class="btn-cta">Explore</button>
        </div>

        <div class="hero-gif">
            <img src="images/innovation.png" alt="GIF showcasing innovation">
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
            <a href="{{ route('investors.index') }}" class="btn-cta">Discover More</a>
        </div>
    </div>

    <!-- Grid Section for the Investors and Companies Tables -->
    <div class="grid-tables">
        <!-- Investors List -->
        <div>
            <h3>Top Investors</h3>
            <table>
                <thead>
                    <tr>
                        <th>Organization Name</th>
                        <th>Number of Contacts</th>
                        <th>Number of Investments</th>
                        <th>Location</th>
                        <th>Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($investors as $investor)
                        <tr>
                            <td>{{ $investor->org_name }}</td>
                            <td>{{ $investor->number_of_contacts }}</td>
                            <td>{{ $investor->number_of_investments }}</td>
                            <td>{{ $investor->location }}</td>
                            <td>{{ $investor->departments }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Companies List -->
        <div>
            <h3>Top Companies</h3>
            <table>
                <thead class="table-light">
                    <tr>
                        <th>Organization Name</th>
                        <th>Founded Date</th>
                        <th>Last Funding Date</th>
                        <th>Last Funding Type</th>
                        <th>Number of Employees</th>
                        <th>Industries</th>
                        <th>Job Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->nama }}</td>
                            <td>{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>{{ $company->last_funding_date ? \Carbon\Carbon::parse($company->last_funding_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>{{ $company->last_funding_type }}</td>
                            <td>{{ $company->number_of_employees }}</td>
                            <td>{{ $company->industries }}</td>
                            <td>{{ $company->job_departments }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
