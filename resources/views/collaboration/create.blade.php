@extends('layouts.app-people')

@section('title', 'Apply for Collaboration')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    /* Mengatur font family untuk seluruh halaman */
    body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }
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
<div class="container" style="margin-top: 60px;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('people.home') }}" style="text-decoration: none; color: #212B36;">Job</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                Apply
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <h2 style="margin-bottom: 24px;">Apply for Collaboration</h2>

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
            <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection
