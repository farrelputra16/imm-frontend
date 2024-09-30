@extends('layouts.app-table')

<style>
 .company-profile-container {
        display: flex;
    }

    .company-profile-wrapper {
        text-align: start;
        margin-bottom: 20px;
        margin-left: 50px;
        margin-top: 20px; 
    }

    .company-profile {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #7b68ee; /* Adjusted softer purple */
    }

    .company-name h3 {
        margin: 0;
        margin-left: 50px;
        font-size: 1.5rem; /* Adjust size of company name */
    }

    .custom-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 50px;
        background-color: #7b68ee; /* Softer purple */
        color: #fff;
        border: solid 1px #7b68ee;
        font-size: 1rem;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        line-height: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 10px;
    }

    .custom-link:hover {
        background-color: #6a5acd; /* Lighter hover effect */
    }


    .company-label .icon {
        margin-right: 8px;
        margin-left: 15px;
        font-size: 1.5rem;
        color: #6a5acd; /* Adjusted to softer hue */
    }

    .company-label .icon {
        margin-right: 8px;
        margin-left: 15px;
        font-size: 1.5rem;
        color: #4735A3;
    }

    /* Container for About and Highlights */
    .row-content {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    /* Line separator between About and Highlights */
    .separator {
        height: 100%;
        width: 1px;
        background-color: #ccc;
        margin: 0 20px;
    }

    /* Adjust column for About and Highlights */
    .col-section {
        flex: 1;
        padding: 20px;
    }

    /* Specific styling for highlights */
    .highlights-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .highlight-box {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .highlight-box:hover {
        transform: translateY(-5px);
    }

    .highlight-content {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .highlight-content h5 {
        color: #6a5acd; /* Matching primary color */
    }
    /* Mengatur lebar kolom tabel */
    table.dataTable th,
    table.dataTable td {
        white-space: nowrap;
    }

    /* Mengatur hover */
    table.dataTable tbody tr:hover {
        background-color: #f2f2f2;
        cursor: pointer;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 0 15px;
    }

    h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4b6584; /* Muted darker blue */
    }

    .card {
        background-color: #f9fafb; /* Slightly lighter background */
        border-radius: 20px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #4b6584; /* Muted greyish-blue */
    }

    .card-text {
        font-size: 1rem;
        color: #747d8c; /* Muted text color */
    }

    .card-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Softer hover effect */
    }

    .text-primary {
        color: #4b6584 !important; /* Muted darker blue */
    }

    .text-info {
        color: #17a2b8;
    }

    .text-info:hover {
        text-decoration: underline;
        color: #29527b; /* Softer transition */
    }

    .fs-1 {
        font-size: 2rem;
    } 
</style>

@section('content')
{{-- Bagian untuk project list --}}
    <!-- Display Ongoing Projects -->
    <div class="container mt-5" style="margin-bottom:20px;">
        <div class="section mt-5">
            <h4 class="text-center mb-5">Ongoing Projects ({{ $ongoingProjects->count() }})</h4>
            @if($ongoingProjects->isEmpty())
                <p class="text-center">No ongoing projects found.</p>
            @else
                <div class="row">
                    @foreach($ongoingProjects as $project)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ $project->img ? asset('images/' . $project->img) : asset('images/default_project.png') }}" class="card-img-top" alt="Project Image">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">{{ $project->nama }}</h5>
                                            <p class="card-text">{{ Str::limit($project->deskripsi, 100) }}</p>
                                            <p><strong>Status:</strong> {{ $project->status }}</p>
                                        </div>
                                        <!-- Tombol View Detail -->
                                        <div class="ml-3">
                                            <a href="{{ route('companies-project.show', $project->id) }}" class="btn btn-primary">View Detail</a>
                                        </div>
                                    </div>                                        
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Display Completed Projects -->
    <div class="container mt-5" style="margin-bottom: 50px;">
        <div class="section mt-5">
            <h4 class="text-center mb-5">Completed Projects ({{ $completedProjects->count() }})</h4>
            @if($completedProjects->isEmpty())
                <p class="text-center">No completed projects found.</p>
            @else
                <div class="row">
                    @foreach($completedProjects as $project)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ $project->img ? asset('images/' . $project->img) : asset('images/default_project.png') }}" 
                                    class="card-img-top" alt="Project Image">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">{{ $project->nama }}</h5>
                                            <p class="card-text">{{ Str::limit($project->deskripsi, 100) }}</p>
                                            <p><strong>Status:</strong> {{ $project->status }}</p>
                                        </div>
                                        <!-- Tombol View Detail -->
                                        <div class="ml-3">
                                            <a href="{{ route('companies-project.show', $project->id) }}" class="btn btn-primary">View Detail</a>
                                        </div>
                                    </div>     
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
