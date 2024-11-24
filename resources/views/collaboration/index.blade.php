@extends('layouts.app-imm')

@section('title', 'Collaboration')

@section('css')
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
    .btn-primary{
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .custom-badge {
        background-color: #6256CA !important; /* Ganti warna latar belakang */
        color: white !important; /* Ganti warna teks */
    }
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
    <div class="table-responsive">
        <table id="ongoing-project-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                    <th scope="col" style="vertical-align: middle;">Title</th>
                    <th scope="col" style="vertical-align: middle;">Image</th>
                    <th scope="col" style="vertical-align: middle;">Description</th>
                    <th scope="col" style="vertical-align: middle;">Position</th>
                    <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($collaborations->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">No data available</td>
                    </tr>
                @else
                    @foreach($collaborations as $collaboration)
                        <tr>
                            <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration }}</td>
                            <td  style="vertical-align: middle;">{{ $collaboration->title }}</td>
                            <td style="vertical-align: middle;"><img src="{{ Storage::url($collaboration->image) }}" width="100" height="auto" alt="Image"></td>
                            <td style="vertical-align: middle;">{{ \Str::limit($collaboration->description, 50) }}</td>
                            <td style="vertical-align: middle;">
                                @php
                                    $positions = explode(', ', $collaboration->position);
                                @endphp
                                @foreach($positions as $position)
                                    <span class="badge custom-badge me-1">{{ $position }}</span>
                                @endforeach
                            </td>
                            <td style="vertical-align: middle; border-right: 1px solid #BBBEC5;">
                                <a href="{{ route('collaboration.edit', $collaboration->id) }}" class="btn btn-outline-primary">Edit</a>
                                <a href="{{ route('collaboration.applicant.index', $collaboration->id) }}" class="btn btn-outline-primary">Applicants</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
     <!-- Footer untuk Proyek Belum Selesai -->
    <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
        <form method="GET" action="{{ route('collaboration.index') }}" class="mb-0">
            <div class="d-flex align-items-center">
                <label for="rowsPerPageOngoing" class="me-2">Rows per page:</label>
                <select name="rows" id="rowsPerPageOngoing" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                    <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <div>
                    <span>Total {{ $collaborations->firstItem() }} - {{ $collaborations->lastItem() }} of {{ $collaborations->total() }}</span>
                </div>
            </div>
            <input type="hidden" name="search" value="{{ request('search') }}">
        </form>
        <div >
            {{ $collaborations->appends(['search' => request('search'), 'rows' => request('rows')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
