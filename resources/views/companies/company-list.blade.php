@extends('layouts.app-table')

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

    .btn-primary {
        background-color: #5940CB;
        border: none;
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #4838b1;
    }

    /* Table Styles */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #5940CB;
        color: white;
    }

    th, td {
        padding: 15px;
        text-align: left;
        font-size: 1rem;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer; /* Add cursor pointer to show clickable row */
    }

    td {
        color: #333;
        font-weight: 400;
    }

    th {
        font-weight: 600;
    }
</style>
@endpush

@section('content')
    <h2><b>COMPANIES</b></h2>
    <form method="GET" action="{{ url('/') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="industry" class="form-control" placeholder="Industry" value="{{ request()->industry }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="departments" class="form-control" placeholder="Departments" value="{{ request()->departments }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Table -->
        <table class="table table-hover mt-4">
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
@endsection

