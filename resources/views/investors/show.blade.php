@extends('layouts.app-table')

<style>
.company-profile-container {
    display: flex;
}

.company-profile-wrapper {
    text-align: start;
    margin-bottom: 20px;
    margin-left: 50px;
    margin-top: 20px;
}

.company-profile {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #7b68ee; /* Adjusted softer purple */
}

.company-name h3 {
    margin: 0;
    margin-left: 50px;
    font-size: 1.5rem; /* Adjust size of company name */
}

.custom-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 50px;
    background-color: #7b68ee; /* Softer purple */
    color: #fff;
    border: solid 1px #7b68ee;
    font-size: 1rem;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    text-decoration: none;
    line-height: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 10px;
}

.custom-link:hover {
    background-color: #6a5acd; /* Lighter hover effect */
}


.company-label .icon {
    margin-right: 8px;
    margin-left: 15px;
    font-size: 1.5rem;
    color: #6a5acd; /* Adjusted to softer hue */
}

.company-label .icon {
    margin-right: 8px;
    margin-left: 15px;
    font-size: 1.5rem;
    color: #4735A3;
}

/* Container for About and Highlights */
.row-content {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

/* Line separator between About and Highlights */
.separator {
    height: 100%;
    width: 1px;
    background-color: #ccc;
    margin: 0 20px;
}

/* Adjust column for About and Highlights */
.col-section {
    flex: 1;
    padding: 20px;
}

/* Specific styling for highlights */
.highlights-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.highlight-box {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    background: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.highlight-box:hover {
    transform: translateY(-5px);
}

.highlight-content {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.highlight-content h5 {
    color: #6a5acd; /* Matching primary color */
}
/* Mengatur lebar kolom tabel */
table.dataTable th,
table.dataTable td {
    white-space: nowrap;
}

/* Mengatur hover */
table.dataTable tbody tr:hover {
    background-color: #f2f2f2;
    cursor: pointer;
}

.container {
    max-width: 1200px;
    margin: auto;
    padding: 0 15px;
}

h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #4b6584; /* Muted darker blue */
}

.card {
    background-color: #f9fafb; /* Slightly lighter background */
    border-radius: 20px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #4b6584; /* Muted greyish-blue */
}

.card-text {
    font-size: 1rem;
    color: #747d8c; /* Muted text color */
}

.card-hover:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Softer hover effect */
}

.text-primary {
    color: #4b6584 !important; /* Muted darker blue */
}

.text-info {
    color: #17a2b8;
}

.text-info:hover {
    text-decoration: underline;
    color: #29527b; /* Softer transition */
}

.fs-1 {
    font-size: 2rem;
}
</style>

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="company-profile-container d-flex align-items-center">
            <div class="company-profile-wrapper">
                <img class="company-profile" src="{{ asset('images/imm.png') }}" alt="Company Profile Image">
            </div>
            <div class="company-name ms-3">
                <h3>{{ $investor->org_name }}</h3>
            </div>
        </div>

        <div class="row" style="padding-left: 50px;">
            <div class="col-sm-6">
                <div class="card-body">
                    <h4 class="card-title">About</h4>
                    <p class="card-text">{{ $investor->description }}</p>
                    <p class="card-text">{{ $investor-> }}</p>
                </div>

                <!-- Location Section -->
                <div class="company-label">
                    <i class="bi bi-geo-alt icon"></i>
                    <a href="/search/organizations/location/new-york-new-york" class="location-link">{{ $investor->location }}</a>
                </div>

                <div class="company-label">
                    <i class="bi bi-globe icon"></i>
                    <a href="/search/organizations/location/united-states" class="location-link">{{ $investor->departments }}</a>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card-body">
                    <h4 class="card-title" style="padding-bottom: 10px;">Highlights</h4>

                    <div class="highlights-container">
                        <!-- Highlight: Funds -->
                        <div class="highlight-box" onclick="window.location.href='#'">
                            <div class="highlight-content">
                                <h6>Funds</h6>
                                <h5>{{ $investor->number_of_contacts}}</h5>
                            </div>
                            <div class="arrow">
                                <h2>&gt;</h2>
                            </div>
                        </div>

                        <!-- Highlight: Employees -->
                        <div class="highlight-box" onclick="window.location.href='#'">
                            <div class="highlight-content">
                                <h6>Karyawan</h6>
                                <h5>{{ $investor->number_of_investments }}</h5>
                            </div>
                            <div class="arrow">
                                <h2>&gt;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container mt-5">
            <h2 class="text-center mb-5 text-primary">Company Overview</h2>
            <div class="row g-4 align-items-stretch">
                <!-- Founded Date -->
                <div class="col-md-4 d-flex">
                    <div class="card card-hover shadow-sm border-0 rounded-lg flex-grow-1 d-flex flex-column">
                        <div class="card-body text-center flex-grow-1">
                            <i class="bi bi-calendar2-date text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">Founded Date</h5>
                            <p class="card-text">{{ $company->founded_date }}</p>
                        </div>
                    </div>
                </div>
                <!-- Team -->
                <div class="col-md-4 d-flex" onclick="window.location.href='{{ route('companies.team', $company->id) }}'">
                    <div class="card card-hover shadow-sm border-0 rounded-lg flex-grow-1 d-flex flex-column">
                        <div class="card-body text-center flex-grow-1">
                            <i class="bi bi-people text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">Team</h5>
                            <p class="card-text">{{ $company->team }}</p>
                        </div>
                    </div>
                </div>
                <!-- Phone -->
                <div class="col-md-4 d-flex">
                    <div class="card card-hover shadow-sm border-0 rounded-lg flex-grow-1 d-flex flex-column">
                        <div class="card-body text-center flex-grow-1">
                            <i class="bi bi-telephone text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">Phone</h5>
                            <p class="card-text">{{ $company->telepon }}</p>
                        </div>
                    </div>
                </div>
                <!-- City -->
                <div class="col-md-4 d-flex">
                    <div class="card card-hover shadow-sm border-0 rounded-lg flex-grow-1 d-flex flex-column">
                        <div class="card-body text-center flex-grow-1">
                            <i class="bi bi-geo-alt text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">City</h5>
                            <p class="card-text">{{ $company->kabupaten }}</p>
                        </div>
                    </div>
                </div>
                <!-- Projects -->
                <div class="col-md-4 d-flex">
                    <div class="card card-hover shadow-sm border-0 rounded-lg flex-grow-1 d-flex flex-column">
                        <div class="card-body text-center flex-grow-1">
                            <i class="bi bi-box-seam text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">Projects</h5>
                            <p><a href="{{ route('companies.project', ['id' => $company->id]) }}" class="text-decoration-none text-info">View Projects</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

<!-- Tambahkan ini di bagian bawah body sebelum penutup tag body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

@endsection
