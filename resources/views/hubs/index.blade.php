@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Updated Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-size: 2.5rem;
        color: #6f42c1;
        margin-bottom: 30px;
        text-align: center;
    }

    .filter-section {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
    }

    .filter-section h5 {
        font-weight: bold;
    }

    .filter-section .form-check-label {
        margin-left: 10px;
    }

    .table-section {
        padding-left: 20px;
    }

    .table-section .form-control {
        border-radius: 20px;
    }

    .table-section .btn {
        border-radius: 20px;
    }

    .table-section .table th {
        background-color: #6f42c1;
        color: white;
    }

    .table-section .table td {
        vertical-align: middle;
    }

    .pagination {
        justify-content: flex-end;
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Innovation Hub</li>
        </ol>
    </nav>

    <h1 class="header">Hubs</h1>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <div class="filter-section">
                <h5>FILTER</h5>

                <form method="GET" action="{{ route('hubs.index') }}">
                    <div class="mb-3">
                        <h6>Location</h6>
                        <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
                    </div>
                    <div class="mb-3">
                        <h6>Rank</h6>
                        <input type="text" name="rank" class="form-control" placeholder="Rank" value="{{ request()->rank }}">
                    </div>
                    <div class="mb-3">
                        <h6>Number of Organizations</h6>
                        <input type="text" name="organization" class="form-control" placeholder="Number of Organizations" value="{{ request()->organization }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search Data" aria-label="Search Data">
                <button class="btn btn-primary" type="button">Search</button>
            </div>

            <!-- Hubs Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Hub Name</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Top Investor Types</th>
                        <th>Top Funding Types</th>
                        <th>Rank</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hubs as $hub)
                    <tr onclick="window.location.href='{{ route('hubs.show', $hub->id) }}'">
                        <td>{{ $hub->name }}</td>
                        <td>{{ $hub->provinsi }}</td>
                        <td>{{ $hub->kota}}</td>
                        <td>{{ $hub->top_investor_types}}</td>
                        <td>{{ $hub->top_funding_types }}</td>
                        <td>{{ $hub->rank }}</td>
                        <td>{{ $hub->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label for="rowsPerPage">Row per page</label>
                    <select id="rowsPerPage" class="form-select d-inline-block w-auto">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                    </select>
                    <span>Total 1-10 of 200</span>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
