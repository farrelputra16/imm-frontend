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

<h2><b>HUBS</b></h2>

<form method="GET" action="{{ route('hubs.index') }}" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="rank" class="form-control" placeholder="Rank" value="{{ request()->rank }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="organization" class="form-control" placeholder="Number of Organizations" value="{{ request()->organization }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<!-- Hubs Table -->
<table class="table table-hover mt-4">
    <thead class="table-light">
        <tr>
            <th>Hub Name</th>
            <th>Location</th>
            <th>Number of Organizations</th>
            <th>Number of People</th>
            <th>Number of Events</th>
            <th>Rank</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hubs as $hub)
        <tr onclick="window.location.href='{{ route('hubs.show', $hub->id) }}'">
            <td>{{ $hub->name }}</td>
            <td>{{ $hub->location }}</td>
            <td>{{ $hub->number_of_organizations }}</td>
            <td>{{ $hub->number_of_people }}</td>
            <td>{{ $hub->number_of_events }}</td>
            <td>{{ $hub->rank }}</td>
            <td>{{ $hub->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
