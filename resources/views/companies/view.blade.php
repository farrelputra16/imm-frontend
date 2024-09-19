@extends('layouts.app-table')

<style>
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
    border: 3px solid #5940CB;
}

.custom-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 50px;
    background-color: #5940CB;
    color: #fff;
    border: solid 1px #5940CB;
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
    background-color: #4735A3;
}

.company-label {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
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
    transition: transform 0.2s ease-in-out;
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
    color: #4735A3;
}

</style>

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="company-profile-wrapper">
            <img class="company-profile" src="{{ asset('images/imm.png') }}" alt="Company Profile Image">
        </div>

        <div class="row" style="padding-left: 50px;">
            <div class="col-sm-6">
                <div class="card-body">
                    <h4 class="card-title">About</h4>
                    <p class="card-text">{{ $company->startup_summary }}</p>
                </div>

                <!-- Location Section -->
                <div class="company-label">
                    <i class="bi bi-geo-alt icon"></i>
                    <a href="/search/organizations/location/new-york-new-york" class="location-link">{{ $company->negara }}</a>
                </div>

                <div class="company-label">
                    <i class="bi bi-globe icon"></i>
                    <a href="/search/organizations/location/united-states" class="location-link">{{ $company->profile }}</a>
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
                                <h5>{{ $company->incomes->count() }}</h5>
                            </div>
                            <div class="arrow">
                                <h2>&gt;</h2>
                            </div>
                        </div>

                        <!-- Highlight: Employees -->
                        <div class="highlight-box" onclick="window.location.href='#'">
                            <div class="highlight-content">
                                <h6>Karyawan</h6>
                                <h5>{{ $company->jumlah_karyawan }}</h5>
                            </div>
                            <div class="arrow">
                                <h2>&gt;</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Company Details</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-building me-2"></i>
                            <span>Profile: {{ $company->profile }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-calendar me-2"></i>
                            <span>Founded Date: {{ $company->founded_date }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-person me-2"></i>
                            <span>PIC Name: {{ $company->nama_pic }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-briefcase me-2"></i>
                            <span>PIC Position: {{ $company->posisi_pic }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-telephone me-2"></i>
                            <span>Phone: {{ $company->telepon }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span>Country: {{ $company->negara }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span>Province: {{ $company->provinsi }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span>City: {{ $company->kabupaten }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-people me-2"></i>
                            <span>Employees: {{ $company->jumlah_karyawan }}</span>
                        </li>
                        <li class="list-group-item">
                            <h5>Description</h5>
                            <p>{{ $company->startup_summary }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>  
        <div class="container mt-5" style="margin-bottom:50px; ">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Investor List</h4>
                    
                    <!-- Tabel Investor -->
                    <table id="investorTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Investor Name</th>
                                <th>Lead Investor</th>
                                <th>Funding Round</th>
                                <th>Tipe Investasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($company->incomes as $income)
                                <tr>
                                    <td>{{ $income->pengirim }}</td>
                                    <!-- Menentukan lead investor berdasarkan funding_type -->
                                    <td>
                                        @if($income->funding_type == 'pre-seed' || $income->funding_type == 'seed' || $income->funding_type == 'series_a' || $income->funding_type == 'series_b' || $income->funding_type == 'series_c')
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($income->funding_type) }}</td>
                                    <td>{{ $income->tipe_investasi ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
