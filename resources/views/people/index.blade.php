@extends('layouts.app-table')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
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

<h2><b>PEOPLE</b></h2>

<form method="GET" action="{{ route('people.index') }}" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="role" class="form-control" placeholder="Role" value="{{ request()->role }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="organization" class="form-control" placeholder="Organization" value="{{ request()->organization }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<!-- People Table -->
<table class="table table-hover mt-4">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Primary Job Title</th>
            <th>Primary Organization</th>
            <th>Role</th>
            <th>Location</th>
            <th>Description</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach($people as $person)
        <tr onclick="window.location.href='{{ route('people.show', $person->id) }}'">
            <td>{{ $person->name }}</td>
            <td>{{ $person->primary_job_title }}</td>
            <td>{{ $person->primary_organization }}</td>
            <td>{{ ucfirst($person->role) }}</td>
            <td>{{ $person->location }}</td>
            <td>{{ $person->description }}</td>
            <td>{{ $person->phone_number }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
