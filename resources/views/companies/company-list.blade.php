@extends('layouts.app-landingpage')

@push('styles')
{{-- Masukkan style yang dibutuhkan --}}
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        font-size: 2rem;
        color: #5940CB;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Search Form Styles */
    form {
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    input[type="text"] {
        font-size: 1rem;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table thead th {
        white-space: nowrap;
    }

    .table-body{
        display: flex;
        flex-direction: row;
    }


    #sdgs-list {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 0;
        overflow: hidden;
        overflow-y: scroll;
        z-index: 1000;
        background-color: white;
        transition: max-height 0.5s ease-out;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    #sdgs-list.active {
        max-height: 500px; /* Sesuaikan tinggi maksimal saat list ditampilkan */
        transition: max-height 0.5s ease-in;
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
        table-layout: auto;
        border-collapse: collapse;
        text-align: left;
    }
</style>
@endpush

@section('content')
<div class="container-fluid" style="margin-top: 100px; margin-bottom: 100px; margin-left: 10px; margin-right:40px; align-content:center;">
    <div class="row" style="align-content:center; justify-content: center;">
        <!-- Form Input Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <!-- Custom Search and Filter Form -->
                    <form id="searchForm" class="search-form" method="GET" action="{{ url('/') }}">
                        @if (request('sdg'))
                            <input type="hidden" value="{{ request('sdg')}}" name="hidden">
                        @endif
                        <div class="row g-3">
                            <!-- Search by Name -->
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <!-- Search by Location -->
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" name="location" class="form-control" placeholder="Search by location" value="{{ request('location') }}">
                                </div>
                            </div>
                            <!-- Filter by SDG -->
                            <div class="col-md-12">
                                <div class="list-group position-relative">
                                    <a href="#" id="toggle-sdg" class="list-group-item list-group-item-action">
                                        All SDGs
                                    </a>
                                    <div id="sdgs-list" class="list-group" style="display: none;">
                                        @for ($i = 1; $i <= 17; $i++)
                                            <a href="{{ url('company') }}?sdg=SDG {{ $i }}" class="list-group-item list-group-item-action {{ request('sdg') === "SDG $i" ? 'active' : '' }}">
                                                SDG {{ $i }}
                                            </a>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary-custom w-100">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-8" style="padding: 0px;">
            <div class="table-responsive">
                <table id="companyTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="all_check"></th>
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
                        <tr>
                            <td><input type="checkbox" class="check" value="{{ $company->id }}"></td>
                            <td>{{ $company->nama }}</td>
                            <td>{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>{{ $company->last_funding_date ? \Carbon\Carbon::parse($company->last_funding_date)->format('F j, Y') : 'N/A' }}</td>
                            <td>{{ $company->last_funding_type }}</td>
                            <td>{{ $company->number_of_employees }}</td>
                            <td>{{ $company->industries }}</td>
                            <td title="{{ $company->description }}" style="font-size: 12px;">{{ Str::limit($company->description, 100) }}</td>
                            <td>{{ $company->job_departments }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>    

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#companyTable').DataTable();
    });
</script>
<script>
    document.getElementById('toggle-sdg').addEventListener('click', function(event) {
        event.preventDefault();
        var sdgList = document.getElementById('sdgs-list');

        if (!sdgList.classList.contains('active')) {
            sdgList.classList.add('active');
            sdgList.style.display = 'block'; // Tampilkan daftar saat tombol diklik
        } else {
            sdgList.classList.remove('active');
            setTimeout(function() {
                sdgList.style.display = 'none'; // Sembunyikan daftar setelah transisi selesai
            }, 500); // Sesuaikan dengan durasi transisi max-height
        }
    });
</script>

@endsection

