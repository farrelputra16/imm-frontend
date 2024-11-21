@extends('layouts.app-imm')

@section('title', 'Collaboration')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
    <style>
        body {
        font-family: Arial, sans-serif;
    }
    .header {
        font-size: 2.5rem;
        font-weight: bold;
        color: #6256CA;
        margin: 20px;
    }
    .table thead th {
        background-color: #6256CA;
        color: white;
    }
        .pagination { justify-content: flex-end; }
    </style>
@endsection

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1">
                <a href="#" style="text-decoration: none; color: #212B36;">Opportunities</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" aria-current="page">
                Collaboration
            </li>
        </ol>
    </nav>
    <!-- Header -->
    <div class="header">Collaboration</div>

    <div class="d-flex justify-content-end align-items-center mb-3"> 
        <!-- Search Input -->
        <form method="GET" action="{{ route('collaboration.index') }}" class="d-inline">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search Collaboration" 
                value="{{ request('search') }}" 
                oninput="this.form.submit()" 
                style="width: 250px;"
            >
        </form>  
        <a href="{{ route('collaboration.create') }}" class="btn btn-primary ms-2">Add</a>
    </div>

    <!-- Collaboration Table -->
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collaborations as $collaboration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $collaboration->title }}</td>
                        <td><img src="{{ Storage::url($collaboration->image) }}" width="100" height="auto" alt="Image"></td>
                        <td>{{ \Str::limit($collaboration->description, 50) }}</td>
                        <td></td>
                        <td>
                            <a href="{{ route('collaboration.edit', $collaboration->id) }}" class="btn btn-outline-primary">Edit</a>
                            <a href="{{ route('collaboration.applicant.index', $collaboration->id) }}" class="btn btn-outline-primary">Applicants</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        {{ $collaborations->links() }}
    </div>
</div>
@endsection