@extends('layouts.app-landingpage')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .breadcrumb {
        background-color: white;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: '>';
    }
    .header-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #6c757d;
        text-align:left;
    }
    .header-subtitle {
        font-size: 2.5rem;
        font-weight: bold;
        color: #6f42c1;
        text-align:left;
    }
    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #d4edda;
        font-weight: bold;
        text-align: center;
    }
    .btn-primary {
        background-color: #6f42c1;
        border: none;
    }
    .btn-primary:hover {
        background-color: #5a32a3;
    }
    .card-title {
        margin-left: 10px; /* Menambahkan jarak antara logo dan nama */
    }
</style>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Innovation Hub</a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">
                Innovation Hub Profile
            </li>
        </ol>
    </nav>
    <div class="text-center">
        <h1 class="header-title">Innovation</h1>
        <h1 class="header-subtitle">Hub Profile</h1>
    </div>
    <div class="card my-4">
        <div class="card-body d-flex align-items-center">
            <img alt="Logo of Lion Bird with text 'Lion Bird Strong Hold'" class="me-3" height="100" src="https://storage.googleapis.com/a1aa/image/svmMvNNpWA7kKFOeJrqN0f1qCFXmF6yZGA92DQARFr6eRoInA.jpg" width="100"/>
            <div>
                <h5 class="card-title">{{ $hub->name }}</h5>
                <p class="card-text">{{ $hub->description }}</p>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <!-- Our Facilities Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Our Facilities</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($facilities as $facility)
                            <li>• {{ $facility }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mentoring Programs Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Mentoring Programs</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($programs as $program)
                            <li>• {{ $program }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Alumni StartUps Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Alumni StartUps</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($alumni as $alum)
                            <li>• {{ $alum }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <button class="btn btn-primary">Event submission</button>
    </div>
</div>
@endsection
