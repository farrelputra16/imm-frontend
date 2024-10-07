@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Updated Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: '>'; /* Use '>' as the separator */
        color: #6c757d; /* Separator color */
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .sidebar {
        width: 250px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .display-4 {
        color:#6f42c1;
        text-align : center;
        font-size:2.5rem;
    }

    .sidebar h5 {
        font-weight: bold;
    }

    .sidebar .form-check-label {
        margin-left: 10px;
    }

    .sidebar .btn {
        margin: 5px 0;
    }

    .content {
        padding: 20px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar input {
        flex: 1;
        margin-right: 10px;
    }

    .table thead th {
        background-color: #6f42c1;
        color:#f8f9fa;
    }

    .table tbody tr {
        background-color: #fff;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .pagination {
        justify-content: flex-end;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">People</li>
                </ol>
            </nav>
            <h1 class="display-4">People</h1>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filter Section -->
        <div class="col-md-3 sidebar">
            <h5>FILTER</h5>
            <form method="GET" action="{{ route('people.index') }}">
                <div class="mb-3">
                    <h6>Location</h6>
                    <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
                </div>
                <div class="mb-3">
                    <h6>Role</h6>
                    <input type="text" name="role" class="form-control" placeholder="Role" value="{{ request()->role }}">
                </div>
                <div class="mb-3">
                    <h6>Organization</h6>
                    <input type="text" name="organization" class="form-control" placeholder="Organization" value="{{ request()->organization }}">
                </div>
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </form>
        </div>

        <!-- Main Content Section -->
        <div class="col-md-9 content">
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search People">
                <button class="btn btn-primary">Search</button>
            </div>

            <!-- People Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Primary Job Title</th>
                        <th scope="col">Primary Organization</th>
                        <th scope="col">Role</th>
                        <th scope="col">Location</th>
                        <th scope="col">Linkedin</th>
                        <th scope="col">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($people as $person)
                    <tr onclick="window.location.href='{{ route('people.show', $person->id) }}'">
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->primary_job_title }}</td>
                        <td>{{ $person->company ? $person->company->nama : 'N/A' }}</td> <!-- Menampilkan nama perusahaan -->
                        <td>{{ ucfirst($person->role) }}</td>
                        <td>{{ $person->location }}</td>
                        <td>
                            @if($person->linkedin_link)
                                <a href="{{ $person->linkedin_link }}" target="_blank">Link</a> <!-- Link ke LinkedIn -->
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $person->phone_number }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option selected>10</option>
                        <option value="1">20</option>
                        <option value="2">30</option>
                    </select>
                    <span>Row per page</span>
                </div>
                <div>
                    <span>Total 1 - 10 of 200</span>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
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
