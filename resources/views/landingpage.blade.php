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

    /* Animasi untuk GIF agar bergerak */
    @keyframes moveSideToSide {
        0% { transform: translateX(0); }
        50% { transform: translateX(-20px); }
        100% { transform: translateX(0); }
    }

    /* Animasi untuk teks besar slide in dari kiri */
    @keyframes slideInLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Animasi untuk teks besar slide in dari kanan */
    @keyframes slideInRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* General Section Styles */
    .hero-section, .reverse-section, .normal-section {
        padding: 60px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hero-content {
        flex: 1;
        max-width: 50%;
        text-align: left;
        animation: slideInLeft 1s ease-out; /* Teks masuk dari kiri */
    }

    .reverse-content, .normal-content {
        flex: 1;
        max-width: 50%;
        text-align: right;
        margin-left: auto;
        animation: slideInRight 1s ease-out; /* Teks masuk dari kanan */
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(90deg, #5940CB, black);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    p {
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

    /* Menambahkan animasi GIF agar bergerak dari sisi ke sisi */
    .hero-gif, .reverse-gif, .normal-gif {
        flex: 1;
        width: 80px;
        height: auto;
        animation: moveSideToSide 4s ease-in-out infinite;
    }

    .hero-gif {
        text-align: right;
    }

    .normal-gif {
        text-align: right;
    }

    /* CTA Section */
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
        animation: slideInLeft 1s ease-out;
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
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Two tables per row */
        gap: 20px;
        margin: 50px auto;
        max-width: 80%;
    }

    .grid-tables > div {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #5940CB;
        width: 100%;
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        transition: transform 0.3s ease;
        table-layout: fixed;
        word-wrap: break-word;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 9px;
        cursor: pointer; /* Add pointer cursor for interactivity */
    }

    th {
        background-color: transparent;
        color: black;
    }

    /* Center the "Top Investors", "Top Companies", and "Top People" titles inside the tables */
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
        .hero-section, .reverse-section, .normal-section {
            flex-direction: column;
            text-align: center;
        }

        .grid-tables {
            grid-template-columns: 1fr; /* Single column on small screens */
        }

        th, td {
            font-size: 10px;
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

    <!-- Reverse Section with GIF on the Left and Text on the Right -->
    <div class="reverse-section">
        <div class="reverse-gif">
            <img src="images/investors.png" alt="GIF showcasing technology">
        </div>

        <div class="reverse-content">
            <h1>Find an Investor!</h1>
            <p>Need Fund for your Project? Search for an Investor.</p>
            <a href="{{ route('investors.index') }}" class="btn-cta">Discover More</a>
        </div>
    </div>

    <!-- New Section with GIF on the Right and Text on the Left -->
    <div class="normal-section">
        <div class="normal-content">
            <h1>Explore Your Next Big Idea</h1>
            <p>Discover innovative projects and partnerships to bring your vision to life.</p>
            <a href="{{ route('companies.list') }}" class="btn-cta">Explore Companies</a>
        </div>

        <div class="normal-gif">
            <img src="images/companies.png" alt="GIF showcasing projects">
        </div>
    </div>

    <!-- Grid Section for the Investors, Companies, People, and Hubs Tables -->
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
                        <tr onclick="window.location='{{ route('investors.index') }}'">
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
                        <th>Description</th>
                        <th>Job Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr onclick="window.location.href='{{ route('companies.show', $company->id) }}'">
                            <td>{{ $company->nama }}</td>
                            <td>{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>{{ $company->latest_income_date ? \Carbon\Carbon::parse($company->latest_income_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>
                                @if ($company->latest_funding_type)
                                    <div>
                                        {{ $company->latest_funding_type }}
                                    </div>
                                @else
                                    No funding data available
                                @endif
                            </td>
                            <td>{{ $company->jumlah_karyawan }}</td>
                            <td>{{ $company->tipe }}</td>
                            <td>{{Str::limit( $company->startup_summary, 10, '...') }}</td>
                            <td>{{ $company->posisi_pic }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- People List -->
        <div>
            <h3>Top People</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Primary Job Title</th>
                        <th>Primary Organization</th>
                        <th>Location</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr onclick="window.location='{{ route('people.index') }}'">
                            <td>{{ $person->name }}</td>
                            <td>{{ ucfirst($person->role) }}</td>
                            <td>{{ $person->primary_job_title }}</td>
                            <td>{{ $person->primary_organization }}</td>
                            <td>{{ $person->location }}</td>
                            <td>{{ $person->phone_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Hubs List -->
        <div>
            <h3>Top Hubs</h3>
            <table>
                <thead>
                    <tr>
                        <th>Hub Name</th>
                        <th>Location</th>
                        <th>Number of Organizations</th>
                        <th>Number of People</th>
                        <th>Number of Events</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hubs as $hub)
                        <tr onclick="window.location='{{ route('hubs.index') }}'">
                            <td>{{ $hub->name }}</td>
                            <td>{{ $hub->location }}</td>
                            <td>{{ $hub->number_of_organizations }}</td>
                            <td>{{ $hub->number_of_people }}</td>
                            <td>{{ $hub->number_of_events }}</td>
                            <td>{{ $hub->rank }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
