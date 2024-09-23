@extends('layouts.app-table')

<style>
    .card {
        height: 100%; /* Mengisi tinggi kolom */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .card img {
        width: 100%; /* Mengisi lebar kotak */
        height: 300px; /* Tinggi tetap */
        object-fit: cover; /* Menjaga rasio aspek */
        border-radius: 0; /* Menghilangkan sudut bulat */
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
    }
</style>

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Meet Our Team</h2>
    <div class="row">
        @foreach ($team as $person)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <img src="{{ isset($person->image) ? asset('images/' . $person->image) : asset('images/1719920573.png') }}" alt="{{ $person->name }}">
                        <h5 class="card-title">{{ $person->name }}</h5>
                        <p class="text-muted mb-2">{{ $person->pivot->position }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
