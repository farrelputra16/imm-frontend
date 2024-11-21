@extends('layouts.app-people')

@section('title', 'Apply for Collaboration')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    body { font-family: Arial, sans-serif; }
    .header { font-size: 2.5rem; font-weight: bold; color: #6256CA; margin: 20px 0; }
    .breadcrumb {
        background-color: white;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }
    .btn-primary {
        background-color: #6256CA;
        border-color: #6256CA;
    }
    .form-label {
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="container"style="margin-bottom:60px; margin-top:20px;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                Apply
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="header">Apply for Collaboration</div>

    <!-- Form -->
    <form action="{{ route('collaboration.applicant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="collaboration_id" class="form-label">Collaboration</label>
            <select name="collaboration_id" id="collaboration_id" class="form-control" required>
                @foreach($collaborations as $collaboration)
                    <option value="{{ $collaboration->id }}">{{ $collaboration->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resume (PDF, DOC, DOCX)</label>
            <input type="file" name="resume" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection