@extends('layouts.app-imm')
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
    .btn-accept {
        color: #28a745;
        border-color: #28a745;
    }
    .btn-reject {
        color: #dc3545;
        border-color: #dc3545;
    }
    .pagination .page-item.active .page-link {
        background-color: #6256CA;
        border-color: #6256CA;
    }
</style>
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1">
                <a href="{{ route('collaboration.index') }}" style="text-decoration: none; color: #212B36;">Opportunities</a>
            </li>
            <li class="breadcrumb-item sub-heading-1">
                <a href="{{ route('collaboration.index') }}" style="text-decoration: none; color: #212B36;">Collaborations</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" aria-current="page">
                Applicants
            </li>
        </ol>
    </nav>
    <div class="header">Applicants</div>
    <div class="table-responsive">
        <table id="ongoing-project-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;"><input type="checkbox"></th>
                    <th scope="col" style="vertical-align: middle;">No.</th>
                    <th scope="col" style="vertical-align: middle;">Name</th>
                    <th scope="col" style="vertical-align: middle;">Position</th>
                    <th scope="col" style="vertical-align: middle;">Resume</th>
                    <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($applicants->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">No data available</td>
                    </tr>
                @else
                    @foreach($applicants as $index => $applicant)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $applicant->name }}</td>
                            <td>{{ $applicant->position }}</td>
                            <td><a href="{{ Storage::url($applicant->resume) }}" target="_blank">View Resume</a></td>
                            <td>
                                <form action="{{ route('collaboration.applicant.approve', $applicant->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-success btn-accept">Approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- Footer untuk Proyek Belum Selesai -->
    <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
        <form method="GET" action="{{ route('collaboration.applicant.index', $collaboration->id) }}" class="mb-0">
            <div class="d-flex align-items-center">
                <label for="rowsPerPageOngoing" class="me-2">Rows per page:</label>
                <select name="rows" id="rowsPerPageOngoing" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                    <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <div>
                    <span>Total {{ $applicants->firstItem() }} - {{ $applicants->lastItem() }} of {{ $applicants->total() }}</span>
                </div>
            </div>
            <input type="hidden" name="search" value="{{ request('search') }}">
        </form>
        <div >
            {{ $applicants->appends(['search' => request('search'), 'rows' => request('rows')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
