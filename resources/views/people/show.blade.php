@extends('layouts.app-landingpage')

<!-- Styles -->
<style>
    .breadcrumb {
        background-color: white;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }

    .profile-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .profile-card img {
        border-radius: 10px;
    }

    .profile-card .designation {
        color: #C1E2A4;
    }

    .profile-card .rating {
        color: #ff9800;
    }

    .profile-card .tags span {
        background-color: #e0e0e0;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        font-size: 0.9rem;
    }

    .document-card-link {
        text-decoration: none; /* Menghilangkan garis bawah pada link */
        display: block; /* Membuat seluruh area kartu dapat diklik */
    }

    .document-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }

    .document-card i {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .document-card .title {
        font-size: 1.2rem;
        font-weight: bold;
    }

</style>

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('people.index') }}" style="text-decoration: none; color: #212B36;">Find Company</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #5A5A5A;" aria-current="page">Profile Company</li>
        </ol>
    </nav>

    <h2>Mentor Profile</h2>

    <div class="profile-card p-4 bg-white">
        <div class="row">
            <div class="col-md-2">
                <img alt="Lion Bird Logo" class="img-profile" height="200" src="{{ !empty($person->image) ? asset($person->image) : asset('images/logo-maxy.png') }}" width="200"/>
            </div>
            <div class="col-md-10">
                <div class="name">
                   <h1 style="color: #3F3F46">{{ $people->name }}</h1>
                </div>
                <div>
                    <h3 class="designation">{{ ucfirst($people->role) }}</h3>
                </div>
                {{-- <div class="rating">
                    4.5
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    (120 Reviews)
                </div> --}}
                <div class="tags mt-3">
                    @foreach (explode(',', $people->skills) as $skill)
                        <span>{{ $skill }}</span>
                    @endforeach
                </div>
                <p class="mt-4">
                    {{ $people->description }}
                </p>
                <div class="contact-info mt-3">
                    <p>
                        <i class="fas fa-phone-alt"></i>
                        {{ $people->phone_number }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $people->location }}
                    </p>
                    <p>
                        @if($people->linkedin_link)
                            <a href="{{ $people->linkedin_link }}" target="_blank">
                                <i class="fab fa-linkedin"></i>  LinkedIn <!-- Ikon LinkedIn di sebelah kiri teks -->
                            </a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <a href="{{ asset($people->cv_path) }}" target="_blank" class="document-card-link">
                <div class="document-card bg-white">
                    <i class="fas fa-file-alt text-primary"></i>
                    <div class="title" style="color: #8079BE;">
                        Curriculum Vitae
                    </div>
                    <p>{{ basename($people->cv_path) }}</p>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ asset($people->portfolio_path) }}" target="_blank" class="document-card-link">
                <div class="document-card bg-white">
                    <i class="fas fa-file-alt text-danger"></i>
                    <div class="title" style="color: #F5848A;">
                        Portfolio
                    </div>
                    <p>{{ basename($people->portfolio_path) }}</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
