@extends('layouts.app-table')

<style>
    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
    }

    .rounded-circle {
        object-fit: cover;
    }
</style>

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Meet Our Team</h2>
    <div class="row">
        @foreach ($company->members as $member)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('images/' . $member->image) }}" alt="{{ $member->name }}" class="rounded-circle mb-3" width="100" height="100">
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="text-muted mb-2">{{ $member->position }}</p>
                        <p class="card-text">{{ $member->achievement }}</p>
                        <p class="card-text">{{ $member->additional_info }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection