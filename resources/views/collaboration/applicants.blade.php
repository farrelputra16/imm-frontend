@extends('layouts.app-imm')
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
                <a href="#" style="text-decoration: none; color: #212B36;">Opportunities</a>
            </li>
            <li class="breadcrumb-item sub-heading-1">
                <a href="#" style="text-decoration: none; color: #212B36;">Collaborations</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" aria-current="page">
                Applicants
            </li>
        </ol>
    </nav>
    <div class="header">Applicants</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox"></th>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Resume</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <select class="form-select" style="width: auto;">
                <option selected>10</option>
                <option value="1">20</option>
                <option value="2">30</option>
            </select>
            <span>Total {{ $applicants->firstItem() }} - {{ $applicants->lastItem() }} of {{ $applicants->total() }}</span>
        </div>
        {{ $applicants->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection